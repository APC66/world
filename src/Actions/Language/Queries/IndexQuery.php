<?php

namespace Apc66\World\Actions\Language\Queries;

use Illuminate\Database\Eloquent\Collection;
use Apc66\World\Models\Language;

class IndexQuery
{
	private array $wheres;

	private array $with;

	private ?string $search;

	public function __construct(array $wheres, array $with, ?string $search = null)
	{
		$this->wheres = $wheres;
		$this->with = $with;
		$this->search = $search;
	}

	public function __invoke(): Collection
	{
		// query
		$query = Language::query();

		$query->when(
			! empty($this->with),
			fn ($q) => $q->with($this->with)
		);

		$query->when(
			! empty($this->wheres),
			fn ($q) => $q->where($this->wheres)
		);

		$query->when(
			$this->search !== null,
			fn ($q) => $q
				->where('code', 'like', '%' . $this->search . '%')
				->orWhere('name', 'like', '%' . $this->search . '%')
		);

		return $query->get();
	}
}
