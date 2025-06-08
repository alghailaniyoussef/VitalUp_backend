<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\HealthNotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendHealthNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-health-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía notificaciones de salud a los usuarios según sus preferencias';

    /**
     * El servicio de notificaciones de salud.
     *
     * @var \App\Services\HealthNotificationService
     */
    protected $healthNotificationService;

    /**
     * Create a new command instance.
     */
    public function __construct(HealthNotificationService $healthNotificationService)
    {
        parent::__construct();
        $this->healthNotificationService = $healthNotificationService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando envío de notificaciones de salud...');

        // Obtener usuarios con preferencias de notificación activas
        $users = User::whereHas('preferences', function($query) {
            $query->whereJsonContains('notification_preferences->quiz_reminders', true);
        })->get();

        $this->info("Se encontraron {$users->count()} usuarios para enviar notificaciones.");

        $sent = 0;
        $errors = 0;

        foreach ($users as $user) {
            try {
                $this->healthNotificationService->scheduleHealthNotifications($user);
                $sent++;
                $this->info("Notificación programada para: {$user->email}");
            } catch (\Exception $e) {
                $errors++;
                Log::error("Error al enviar notificación de salud a {$user->email}: {$e->getMessage()}");
                $this->error("Error al enviar notificación a {$user->email}");
            }
        }

        $this->info("Proceso completado. Notificaciones enviadas: {$sent}. Errores: {$errors}");

        return 0;
    }
}
