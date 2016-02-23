<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\CupomRepository;

class CupomController extends Controller
{
    /**
     * @var CupomRepository
     */
    private $cupomRepository;

    /**
     * CupomController constructor.
     *
     * @param CupomRepository $cumpoRepository
     */
    public function __construct(CupomRepository $cumpoRepository)
    {
        $this->cupomRepository = $cumpoRepository;
    }

    /**
     * Show the cupom by code
     *
     * @param $code
     * @return mixed
     */
    public function show($code)
    {
        return $this->cupomRepository->skipPresenter(false)->findByCode($code);
    }

}
