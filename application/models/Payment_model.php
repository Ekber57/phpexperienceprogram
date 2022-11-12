<?php
// require("a.php");
class Payment_model extends CI_Model
{

    public function add($paymentEnity)
    {
        $data = array(
            'amount' => $paymentEnity->amount,
            'payment_type' => $paymentEnity->payment_type,
            'user_id' => $paymentEnity->user_id,
            'currency_id' => $paymentEnity->currency_id
        );
        $this->db->insert('payments', $data);
    }

    public  function getPaymentStatics()
    {

        $sql = "SELECT payments.id, DATE_FORMAT(payments.date,'%d-%m-%Y') as date,payments.user_id,users.name as user, currencies.name as currency,sum(
            case when payment_type=1 then amount else 0.00 end) as medaxil,
            sum(case when payment_type=2 then amount else 0.00 end) as mexaric
            FROM payments
            inner join users on payments.user_id=users.id
            inner join currencies on payments.currency_id=currencies.id
            group by currencies.id,users.id
            Order By payments.user_id
            ";

        $payments = $this->db->query($sql);
        return ($payments->custom_result_object('PaymentDTO'));
        // return $this->getFilteredPayments();
    }






    public  function getAll()
    {

        $sql = "SELECT payments.id, DATE_FORMAT(payments.date,'%d-%m-%Y') as date,payments.user_id,users.name as user, currencies.name as currency,
        if(payments.payment_type=1,payments.amount,0.00) as medaxil,
        if(payments.payment_type=2,payments.amount,0.00) as mexaric
            FROM payments
            inner join users on payments.user_id=users.id
            inner join currencies on payments.currency_id=currencies.id
            Order by payments.date
            ";
        $payments = $this->db->query($sql);
        return ($payments->custom_result_object('PaymentDTO'));
    }












    public  function getPaymentsByUser($userId = "Ekber")
    {

        $sql = "SELECT DATE_FORMAT(payments.date,'%d-%m-%Y') as date,payments.date, payments.currency_id,payments.id,payments.user_id,users.name as user, currencies.name as currency,
        case when payment_type=1 then amount else 0.00 end as medaxil,
        case when payment_type=2 then amount else 0.00 end as mexaric
    
            FROM payments
            inner join users on payments.user_id=users.id
            inner join currencies on payments.currency_id=currencies.id
            HAVING user_id=?";


        $payments = $this->db->query($sql, array($userId));
        return ($payments->custom_result_object('PaymentDTO'));
    }



    public  function getPaymentsByCurrency($currencyId = 1)
    {
        $sql = "SELECT DATE_FORMAT(payments.date,'%d-%m-%Y') as date,payments.date ,payments.currency_id,payments.id,payments.user_id,users.name as user, currencies.name as currency,
            case when payment_type=1 then amount else 0.00 end as medaxil,
            case when payment_type=2 then amount else 0.00 end as mexaric
        
            FROM payments
            inner join users on payments.user_id=users.id
            inner join currencies on payments.currency_id=currencies.id
            HAVING payments.currency_id=?";
        $payments = $this->db->query($sql, array($currencyId));
        return ($payments->custom_result_object('PaymentDTO'));
    }



    public  function getPaymentsByCurrencyAndUser($userId, $currencyId)
    {

        $sql = "SELECT DATE_FORMAT(payments.date,'%d-%m-%Y') as date,payments.date ,payments.currency_id,payments.id,payments.user_id,users.name as user, currencies.name as currency,
        case when payment_type=1 then amount else 0.00 end as medaxil,
        case when payment_type=2 then amount else 0.00 end as mexaric
    
            FROM payments
            inner join users on payments.user_id=users.id
            inner join currencies on payments.currency_id=currencies.id
            HAVING payments.user_id=? and payments.currency_id=?";
        $payments = $this->db->query($sql, array($userId, $currencyId));
        return ($payments->custom_result_object('PaymentDTO'));
    }

    public  function getPaymentsByCurrencyAndDate($filter)
    {

        $sql = "SELECT DATE_FORMAT(payments.date,'%d-%m-%Y') as date,payments.date ,payments.currency_id,payments.id,payments.user_id,users.name as user, currencies.name as currency,
            case when payment_type=1 then amount else 0.00 end as medaxil,
            case when payment_type=2 then amount else 0.00 end as mexaric
        
            FROM payments
            inner join users on payments.user_id=users.id
            inner join currencies on payments.currency_id=currencies.id
           HAVING payments.currency_id=? and payments.date >= ? and payments.date <= ?";
        $payments = $this->db->query($sql, array($filter["currencyId"], $filter["dateFrom"], $filter["dateTo"]));
        return ($payments->custom_result_object('PaymentDTO'));
    }



    public  function getPaymentsByDate($dateFrom, $dateTo)
    {
        $sql = "SELECT DATE_FORMAT(payments.date,'%d-%m-%Y') as date,payments.date, payments.currency_id,payments.id,payments.user_id,users.name as user, currencies.name as currency,
        case when payment_type=1 then amount else 0.00 end as medaxil,
        case when payment_type=2 then amount else 0.00 end as mexaric
    
            FROM payments
            inner join users on payments.user_id=users.id
            inner join currencies on payments.currency_id=currencies.id
         
            HAVING payments.date >= ? and payments.date <= ?
            Order By payments.date
            ";
        $payments = $this->db->query($sql, array($dateFrom, $dateTo));
        return ($payments->custom_result_object('PaymentDTO'));
    }



    public  function getPaymentsDoToAllFilter($filter)
    {

        $sql = "SELECT DATE_FORMAT(payments.date,'%d-%m-%Y') as date,payments.date, payments.currency_id,payments.id,payments.user_id,users.name as user, currencies.name as currency,
        case when payment_type=1 then amount else 0.00 end as medaxil,
        case when payment_type=2 then amount else 0.00 end as mexaric
    
        
            FROM payments
            inner join users on payments.user_id=users.id
            inner join currencies on payments.currency_id=currencies.id
            HAVING payments.user_id=? and payments.currency_id=? and payments.date >= ? and payments.date <= ?
            Order By payments.date";
        $payments = $this->db->query($sql, array($filter["userId"], $filter["currencyId"], $filter["dateFrom"], $filter["dateTo"]));
        return ($payments->custom_result_object('PaymentDTO'));
    }
}









class PaymentDTO
{
    public $medaxil;
    public $userId;
    public $user;
    public $qaliq;

    public function __construct()
    {
        $this->qaliq = $this->medaxil - $this->mexaric;
    }
}
