<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Transaction;

class ApiController extends Controller {


    /** adding of a customer:
     * ○ Request: ​
     * name, cnp
     * ○ Response: ​
     * customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCustomer($name, $cnp) {

        $c = new Customer;
        $c->name = $name;
        $c->cnp = $cnp;

        /** имя не уникально
         * в laravel есть встроеная валидация, но она не подходит для запросов с параметрами в url'ах
         */
        try {
            $c->save();
            return response()->json([
                'customerId' => $c->id
            ], 200);
        } catch (\Exception $e) {
            return response()->json([], 400);
        }
    }

    /** getting a transaction:
     * ○ Request:
     * customerId, transactionId
     * ○ Response: ​
     * transactionId, amount, date
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTransaction($customerId, $transactionId) {

        /** транзакции и так связаны с customer'ами, 1й параметр нужен? */
        $t = Transaction::find($transactionId);

        if (is_null($t)) {
            return response()->json([], 200);
        }

        return response()->json([
            'transactionId' => $t->id,
            'amount' => $t->amount,
            'date' => $t->updated_at
        ], 200);
    }

    /** getting transaction by filters:
     * ○ Request: ​
     * customerId, amount, date, offset, limit
     * ○ Response: ​
     * an array of transactions
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTransactionByFilters($customerId, $amount, $date, $offset, $limit) {

        error_log('hello');
        $ta = Transaction::getTransactionByFilters($customerId, $amount, $date, $offset, $limit);

        return response()->json([
            'transactions' => $ta
        ], 200);
    }

    /** adding a transaction:
     * ○ Request: ​
     * customerId, amount
     * ○ Response: ​
     * transactionId, customerId, amount, date
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTransaction($customerId, $amount) {

        $t = new Transaction;
        $t->amount = $amount;
        $t->customer_id = $customerId;

        try {
            $t->save();
            return response()->json([
                'transactionId' => $t->id,
                'customerId' => $t->customer_id,
                'amount' => $t->amount,
                'date' => $t->updated_at
            ], 200);
        } catch (\Exception $e) {
            return response()->json([], 400);
        }
    }

    /** updating a transaction:
     * ○ Request: ​
     * transactionId, amount
     * ○ Response: ​
     * transactionId, customerId, amount, date
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTransaction($transactionId, $amount) {

        /**
         * проверку на int упустим, поверим на слово
         */
        $t = Transaction::find($transactionId);

        if (is_null($t)) {
            return response()->json([], 400);
        }

        $t->amount = $amount;
        $t->save();

        return response()->json([
            'transactionId' => $t->id,
            'customerId' => $t->customer_id,
            'amount' => $t->amount,
            'date' => $t->updated_at
        ], 200);
    }

    /** deleting a transaction:
     * ○ Request: ​
     * trasactionId
     * ○ Response: ​
     * success/fail
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteTransaction($transactionId) {

        $t = Transaction::find($transactionId);

        if (is_null($t)) {
            return response()->json([], 400);
        }

        $t->delete();
        return response()->json([], 200);
    }

    /** get all transactions:
     * ○ Request: ​
     * ○ Response: ​
     * []
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTransactions() {

        $ta = Transaction::all();

        if (is_null($ta)) {
            return response()->json([], 400);
        }

        return response()->json([
            'transactions' => $ta
        ], 200);
    }
}