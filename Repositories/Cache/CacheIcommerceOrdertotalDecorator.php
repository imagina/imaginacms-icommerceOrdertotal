<?php

namespace Modules\Icommerceordertotal\Repositories\Cache;

use Modules\Icommerceordertotal\Repositories\IcommerceOrdertotalRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheIcommerceOrdertotalDecorator extends BaseCacheDecorator implements IcommerceOrdertotalRepository
{
    public function __construct(IcommerceOrdertotalRepository $icommerceordertotal)
    {
        parent::__construct();
        $this->entityName = 'icommerceordertotal.icommerceordertotals';
        $this->repository = $icommerceordertotal;
    }

    /**
   * List or resources
   *
   * @return mixed
   */
    public function calculate($parameters,$conf)
    {
        
        return $this->repository->calculate($parameters,$conf);
        
    }

}
