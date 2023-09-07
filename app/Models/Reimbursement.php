<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reimbursement extends Model
{
    use HasFactory;
    protected $table = 'reimbursements';
    protected $guarded = [];
    protected $with = ['userCreate','userAction'];
    
    const KODE_DOC = 'RE';
    
    const PENDING = 0;
    const APPROVE = 1;
    const REJECT = 2;

    public function userCreate() 
    {
        return $this->hasOne(User::class, 'id','user_created');
    }
    public function userAction() 
    {
        return $this->hasOne(User::class, 'id','user_action');
    }
    public function scopePending($query)
    {
        return $query->where('status',0);
    }
    public function scopeApprove($query)
    {
        return $query->where('status', 1);
    }
    public function scopeReject($query)
    {
        return $query->where('status', 2);
    }
    function pushStatus($status) {
        $this->update(['status'=>$status,'user_action'=> Auth::user()->id]);
    }
    function scopeGetStatus() {
         switch ($this->status) {
            case 0:
                return 'PENDING';
                break;
            case 1:
                return 'APPROVED';
                break;
            case 2:
                return 'REJECTED';
                break;
            default:
                # code...
                break;
        }
    }
    function scopeLastNomor() {
        $lastNomor = $this->max('nomor');
        if (!$lastNomor) {
            return 0;
        }
        return $lastNomor;
    }
    
}