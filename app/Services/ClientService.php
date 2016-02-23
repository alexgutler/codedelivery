<?php

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;

class ClientService
{
    private $clientRepository;
    private $userRepository;

    public function __construct(ClientRepository $clientRepository, UserRepository $userRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        // define a senha padrão no cadastro de clientes
        $data['user']['password'] = bcrypt(123456);
        // cria primeiro na tabela de usuarios
        $user = $this->userRepository->create($data['user']);
        // coloca no array com os dados da tabela clients o user_id que acabou de ser salvo
        $data['user_id'] = $user->id;
        // cadastra na tabela de clients
        $this->clientRepository->create($data);
    }

    public function update(array $data, $id)
    {
        // atualiza os dados na tabela clients
        $this->clientRepository->update($data, $id);
        // busca o user_id na tabela clients para atualizar os dados na tabela users
        $userId = $this->clientRepository->find($id)->user_id;
        // atualiza os dados da tabela users
        $this->userRepository->update($data['user'], $userId);
    }
}