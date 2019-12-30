<?php

namespace Chrisjk123\Blogger;

use Illuminate\Support\Facades\Facade;

/**
 * @see \chrisjk123\Blogger\Skeleton\SkeletonClass
 */
class BloggerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'blogger';
    }
}
