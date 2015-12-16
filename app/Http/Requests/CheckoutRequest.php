<?php

namespace CodeDelivery\Http\Requests;

use Illuminate\Http\Request as HttpRequest;

class CheckoutRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(HttpRequest $request)
    {
        $rules = [
            'cupom_code' => 'exists:cupoms,code,used,0', // o cupom tem que existir na tabela (table, campo) e o cupom não pode estar usado
        ];
        $this->buildRulesItems(0, $rules); // obriga a passar ao menos um item

        $items = $request->get('items',[]);
        $items = !is_array($items) ? [] : $items; // garante que seja um array
        foreach($items as $key => $val) {
            $this->buildRulesItems($key, $rules);
        }

        return $rules;
    }

    /**
     * Adiciona as rules para os items
     *
     * @param $key
     * @param array $rules
     */
    public function buildRulesItems($key, array &$rules) // &$rules = passa o array $rules por referencia
    {
        $rules["items.$key.product_id"] = 'required';
        $rules["items.$key.qtd"] = 'required';
    }

}
