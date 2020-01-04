<?php

namespace Chriscreates\Blog\Builders;

use Carbon\Carbon;
use Chriscreates\Blog\Exceptions\ColumnNotFoundException;
use Illuminate\Database\Eloquent\Builder as BaseBuilder;
use Illuminate\Support\Facades\Schema;

class Builder extends BaseBuilder
{
    /**
     * Return results where created_at between now and last month.
     *
     * @return \Chriscreates\Blog\Builders\Builder
     */
    public function lastMonth() : Builder
    {
        return $this->whereBetween('created_at', [
            Carbon::now()->subMonth(), Carbon::now(),
        ])->latest();
    }

    /**
     * Return results where created_at between now and last week.
     *
     * @return \Chriscreates\Blog\Builders\Builder
     */
    public function lastWeek() : Builder
    {
        return $this->whereBetween('created_at', [
            Carbon::now()->subWeek(), Carbon::now(),
        ])->latest();
    }

    /**
     * Return results where slug matches.
     *
     * @param string $status
     * @return \Chriscreates\Blog\Builders\Builder
     */
    public function slug(string $slug) : Builder
    {
        // Check whether queried table has 'slug' column
        if ( ! Schema::hasColumn($this->model->getTable(), 'slug')) {
            $message = "Column 'slug' not found in {$this->model->getTable()} table";

            throw new ColumnNotFoundException($message);
        }

        return $this->where('slug', $slug);
    }
}
