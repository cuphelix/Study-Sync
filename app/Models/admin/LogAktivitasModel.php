<?php

namespace App\Models\admin;

use CodeIgniter\Model;

class LogAktivitasModel extends Model
{
    protected $table = 't_log_aktivitas';
    protected $primaryKey = 'id_log';
    protected $allowedFields = [
        'user_type',
        'user_id',
        'action',
        'table_name',
        'record_id',
        'description',
        'ip_address',
        'user_agent'
    ];
    
    public function getRecentActivities($limit = 10)
    {
        return $this->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }
    
    public function logActivity($userType, $userId, $action, $tableName = null, $recordId = null, $description = null)
    {
        $request = \Config\Services::request();
        
        return $this->insert([
            'user_type' => $userType,
            'user_id' => $userId,
            'action' => $action,
            'table_name' => $tableName,
            'record_id' => $recordId,
            'description' => $description,
            'ip_address' => $request->getIPAddress(),
            'user_agent' => $request->getUserAgent()->getAgentString()
        ]);
    }
}

