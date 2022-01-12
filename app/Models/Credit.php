<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Credit extends Model
{
    use HasFactory;

    protected $fillable = [ 'id','individual_credit','seller_credit',
    'aditional_credit','renovation_credit','insurance_credit','guarantee',
    'num_credit','type_id','num_id','auth_date','civil_state','regimen',
    'current_house','economic','entreprise_name','NRP','entreprise_phone',
    'schedule_in','schedule_out','last_name2','second_last_name2','name2',
    'phone2','cellphone2','last_name3','second_last_name3','name3','phone3',
    'cellphone3','last_name_aval','second_last_name_aval','name_aval','phone_aval',
    'type_warranty','description_warranty','model_warranty','serie_warranty','placa_warranty',
    'color_warranty','pension','time_Credit','want_credit','check_credit','bank_name',
    'credit_bank_number','credit_bank_key','city_of','client_id','interes','total_credit','status','fileName','url','payment_status','address',
    'amountPay'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function changeStatus($data){
        return $this->fill(["status"=>$data])->save();
    }
    public function payments(){
        return $this->hasMany(Payment::class)->select('id','credit_id','fecha_limite',DB::raw('DATEDIFF(fecha_limite,CURDATE()) AS Days'))->orderBy('id', 'desc');

    }
    public function latestPayment()
	{
		return $this->payments()->latest();
	}
}
