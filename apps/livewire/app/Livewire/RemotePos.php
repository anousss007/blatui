<?php

namespace App\Livewire;

use Livewire\Attributes\Renderless;
use Livewire\Component;

/**
 * #61: the reporter's POS checkout and stock transfer, to prove the pattern we recommend for
 * lists too big to send. A customer search over 87,018 rows and a product search over 50,000,
 * both remote comboboxes paging through #[Renderless] methods, so a search or a page is data and
 * never a render. Picking a customer swaps the field for a card in the browser; picking a product
 * adds a line (or one more of it) to `lines`, also in the browser. Only save() renders.
 *
 * No database in this app: the rows are generated, deterministically, on each search. That costs
 * what a real query would, more or less, and keeps the tests free of fixtures.
 */
class RemotePos extends Component
{
    public const CUSTOMERS = 87_018;

    public const PRODUCTS = 50_000;

    private const FIRST = ['Ana', 'Luis', 'José', 'María', 'Carlos', 'Rosa', 'Jorge', 'Lucía', 'Pedro', 'Elena', 'Héctor', 'Sofía', 'Miguel', 'Carmen', 'Raúl', 'Julia', 'Diego'];

    private const LAST = ['García', 'Huamán', 'Quispe', 'Flores', 'Rojas', 'Mendoza', 'Torres', 'Ramírez', 'Castillo', 'Vargas', 'Chávez', 'Fernández', 'Gutiérrez', 'Sánchez', 'Díaz', 'Ruiz', 'Paredes', 'Salazar', 'Ríos', 'Medina', 'Vega', 'Cruz', 'Ortiz'];

    private const ITEMS = ['Tornillo', 'Tuerca', 'Arandela', 'Clavo', 'Perno', 'Bisagra', 'Cable', 'Tubo', 'Codo', 'Llave', 'Brocha', 'Cinta', 'Pegamento', 'Lija', 'Broca'];

    private const SIZES = ['1/4"', '3/8"', '1/2"', '3/4"', '1"', '2"', '6 mm', '8 mm', '10 mm', '12 mm'];

    public ?int $customerId = null;

    public bool $walkIn = false;

    /** One per product: [key, variantId, sku, barcode, productName, salePrice, availableStock, quantity]. */
    public array $lines = [];

    public ?string $saved = null;

    public static function customer(int $i): array
    {
        $name = self::FIRST[$i % 17].' '.self::LAST[intdiv($i, 17) % 23].' '.self::LAST[intdiv($i, 391) % 23];
        $document = $i % 7 === 0 ? (string) (20_000_000_000 + $i * 13) : sprintf('%08d', 40_000_000 + $i * 7);

        return ['value' => $i, 'label' => mb_strtoupper($name), 'document' => $document];
    }

    public static function product(int $i): array
    {
        return [
            'value' => $i,
            'label' => self::ITEMS[$i % 15].' '.self::SIZES[intdiv($i, 15) % 10].' #'.$i,
            'sku' => sprintf('SKU-%05d', $i),
            'barcode' => (string) (775_000_000_000 + $i),
            'salePrice' => round(0.5 + ($i % 400) * 0.35, 2),
            'availableStock' => ($i * 37) % 250,
        ];
    }

    /** Lower case, no accents: what a database collation would compare. */
    private static function fold(string $text): string
    {
        return mb_strtolower(preg_replace('/\p{Mn}/u', '', \Normalizer::normalize($text, \Normalizer::FORM_D)));
    }

    /**
     * Every word of the query in the name, in any order, or a document that starts with it.
     * "luis garcia" finds "LUIS GARCÍA HUAMÁN" and "LUIS QUISPE GARCÍA": a match a browser-side
     * `includes` of the whole query would hide again, which is why a remote combobox does not filter.
     */
    #[Renderless]
    public function searchCustomers(string $query, int $offset = 0, int $limit = 30): array
    {
        $words = array_filter(explode(' ', self::fold(trim($query))));
        $limit = max(1, min(100, $limit));
        $found = [];
        $matched = 0;
        // One past the page tells whether there is a next one.
        foreach ($this->customers() as $c) {
            $name = self::fold($c['label']);
            $hit = ! $words
                || str_starts_with($c['document'], trim($query))
                || array_all($words, fn ($w) => str_contains($name, $w));
            if ($hit && $matched++ >= $offset && count($found[] = $c) > $limit) {
                break;
            }
        }

        return ['options' => array_slice($found, 0, $limit), 'hasMore' => count($found) > $limit];
    }

    /** The ones created at the till first, then the generated ones. */
    private function customers(): \Generator
    {
        yield from session('pos-customers', []);
        for ($i = 1; $i <= self::CUSTOMERS; $i++) {
            yield self::customer($i);
        }
    }

    /** By barcode or SKU exactly (a scanner), else by name or SKU. */
    #[Renderless]
    public function searchProducts(string $query, int $offset = 0, int $limit = 30): array
    {
        $q = self::fold(trim($query));
        $limit = max(1, min(100, $limit));
        if ($q !== '' && ctype_digit($q) && strlen($q) === 12) {
            $i = (int) $q - 775_000_000_000;

            return ['options' => $i >= 1 && $i <= self::PRODUCTS ? [self::product($i)] : [], 'hasMore' => false];
        }
        $found = [];
        $matched = 0;
        for ($i = 1; $i <= self::PRODUCTS && count($found) <= $limit; $i++) {
            $p = self::product($i);
            if ($q === '' || str_contains(self::fold($p['label']), $q) || str_contains(strtolower($p['sku']), $q)) {
                if ($matched++ >= $offset) {
                    $found[] = $p;
                }
            }
        }

        return ['options' => array_slice($found, 0, $limit), 'hasMore' => count($found) > $limit];
    }

    /** The "new customer" dialog: returns the option, so the page shows it without a render. */
    #[Renderless]
    public function createCustomer(string $name, string $document): array
    {
        $created = session('pos-customers', []);
        $customer = ['value' => self::CUSTOMERS + count($created) + 1, 'label' => mb_strtoupper(trim($name)), 'document' => trim($document)];
        session(['pos-customers' => [...$created, $customer]]);
        $this->customerId = $customer['value'];
        $this->walkIn = false;

        return $customer;
    }

    /** The one request that renders: what the server received, as the server sees it. */
    public function save(): void
    {
        $ids = array_column($this->lines, 'variantId');
        abort_if(count($ids) !== count(array_unique($ids)), 422, 'A product is on two lines.');

        $who = $this->walkIn ? 'walk-in' : ($this->customerId ? 'customer '.$this->customerId : 'no customer');
        $this->saved = $who.'; '.implode(', ', array_map(fn ($l) => $l['sku'].' x'.$l['quantity'], $this->lines));
    }

    public function render()
    {
        return view('livewire.remote-pos');
    }
}
