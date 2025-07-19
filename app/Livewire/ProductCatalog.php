<?php
declare(strict_types=1);

namespace App\Livewire;

use App\Data\ProductCollectionData;
use App\Data\ProductData;
use App\Models\Product;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class ProductCatalog extends Component
{
    use WithPagination;

    public $queryString = [
        'select_collection' => ['except' => []],
        'search' => ['except' => []],
        'sort_by' => ['except' => 'newest']
    ];

    public array $select_collection = [];

    public string $search = '';

    public string $sort_by = 'newest';

    public function mount() {
        $this->validate();
    }

    protected function rules() {
        return [
            'select_collection' => 'array',
            'select_collection.*' => 'integer|exists:tags,id',
            'search' => 'string|nullable|min:3|max:30',
            'sort_by' => 'in:newest,latest,price_asc,price_desc'
        ];
    }

    public function applyFilters() {
        $this->validate();

        $this->resetPage();
    }

    public function resetFilters() {
        $this->select_collection = [];
        $this->search = '';
        $this->sort_by = 'newest';

        $this->resetErrorBag();
        $this->resetPage();
    }

    public function render()
    {        

        $collections = ProductCollectionData::collect([]);
        $products = ProductData::collect([]);

        if ($this->getErrorBag()->isNotEmpty()) {
            return view('livewire.product-catalog', compact('products', 'collections'));
        }

        $collection_query = Tag::query()->withType('collection')->withCount('products')->get();
        // $query = Product::paginate(6);

        $result = Product::query();

        if ($this->search) {
            $result->where('name', 'LIKE', "%{$this->search}%");
        }

        if (!empty($this->select_collection)) {
            $result->whereHas('tags', function($result){
                $result->whereIn('id', $this->select_collection);
            });
        }

        switch ($this->sort_by) {
            case 'latest':
                $result->oldest();
                break;
            case 'price_asc':
                $result->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $result->orderBy('price', 'desc');
            default:
                $result->latest();
                break;
        }

        // TODO make a DTO
        $products = ProductData::collect($result->paginate(6));
        $collections = ProductCollectionData::collect($collection_query);

        return view('livewire.product-catalog', compact('products', 'collections'));
    }
}
