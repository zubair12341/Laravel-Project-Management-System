<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Client;
use App\Models\Project;

class ClientInvoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_no',
        'client_id',
        'from_date',
        'to_date',
        'discount',
        'grand_total',
        'notes',
        'task_module_id',
        'created_at',
        'updated_at'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function task_module()
    {
        return $this->belongsTo(TaskModule::class);
    }

    public function clientInvoiceDetail()
    {
        return $this->hasMany(clientInvoiceDetail::class);
    }
    
    public function Project(){
        
        return $this->belongsTo(Project::class);
    }

}
