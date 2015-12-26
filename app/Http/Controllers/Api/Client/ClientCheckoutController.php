<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderService
     */
    private $service;

    private $with = ['client', 'cupom', 'items', 'deliveryman'];

    public function __construct(OrderRepository $orderRepository,
                                UserRepository $userRepository,
                                OrderService $orderService
    ){
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->service = $orderService;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $clientId = $this->userRepository->skipPresenter(true)->find($id)->client->id;
        $orders = $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)->scopeQuery(function($query) use($clientId){
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return $orders;
    }

    public function store(Requests\CheckoutRequest $request)
    {
        $data = $request->all();

        $id = Authorizer::getResourceOwnerId();

        $clientId = $this->userRepository->skipPresenter(true)->find($id)->client->id;
        $data['client_id'] = $clientId;
        $o = $this->service->create($data);
        return $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($o->id);
    }

    public function show($id)
    {
//        $o = $this->orderRepository->with(['client', 'items', 'cupom'])->find($id);
//        $o = $this->orderRepository->skipPresenter()->with(['client', 'items', 'cupom'])->find($id);
        /* $o->items->each(function($item){
            $item->product;
        }); */
        return $this->orderRepository
            ->skipPresenter(false)
            ->with($this->with)
            ->find($id);
    }
}
