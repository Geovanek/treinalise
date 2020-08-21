<?php
declare(strict_types=1);

namespace App\Tenant;

use App\Models\Company;
use Illuminate\Database\Schema\Blueprint;

class TenantManager
{
    private $tenant;
    private static $tenantTable = 'companies';
    private static $tenantField = 'company_id';
    private static $tenantCoach = 'coach_id';
    private static $tenantModel = Company::class;

    /**
     * @return string
     */
    public function getTenantTable(): string
    {
        return self::$tenantTable;
    }

    /**
     * @return string
     */
    public function getTenantField(): string
    {
        return self::$tenantField;
    }

    /**
     * @return string
     */
    public function getTenantModel(): string
    {
        return self::$tenantModel;
    }

    /**
     * @return Company
     */
    public function getTenant(): ?Company //null or Company
    {
        return $this->tenant;
    }

    /**
     * @param Company $tenant
     */
    public function setTenant(?Company $tenant): void
    {
        $this->tenant = $tenant;
    }

    public function bluePrintMacros()
    {
        Blueprint::macro('tenantCompany', function(){
            $this->bigInteger(\Tenant::getTenantField())->unsigned()->nullable();
            $this->foreign(\Tenant::getTenantField())->references('id')->on(\Tenant::getTenantTable());
        });

        Blueprint::macro('tenantCoach', function(){
            $this->bigInteger('coach_id')->unsigned()->nullable();
            $this->foreign('coach_id')->references('id')->on('coaches');
        });
    }

    public function ruleExists()
    {
        return "{$this->getTenantField()},{$this->getTenant()->id()}";
    }
}