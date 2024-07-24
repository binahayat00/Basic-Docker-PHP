<?php

declare(strict_types= 1);

namespace Tests\Unit\Services;

use App\Services\EmailService;
use App\Services\GatewayService;
use App\Services\InvoiceService;
use App\Services\SalesTaxService;

class InvoiceServiceTest extends \PHPUnit\Framework\TestCase
{
    public function test_processes_invoice(): void
    {
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $gatewayServiceMock = $this->createMock(GatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);

        $gatewayServiceMock->method('charge')->willReturn(true);

        $invoiceService = new InvoiceService(
            $salesTaxServiceMock,
            $gatewayServiceMock,
            $emailServiceMock,
        );

        $customer = ['name' => 'Amir'];
        $amount = 100;

        $result = $invoiceService->process(
            $customer,
            $amount,
        );

        $this->assertTrue($result);
    }

    public function test_sends_receipt_email_when_invoice_is_processed(): void
    {
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $gatewayServiceMock = $this->createMock(GatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);

        $gatewayServiceMock->method('charge')->willReturn(true);

        $invoiceService = new InvoiceService(
            $salesTaxServiceMock,
            $gatewayServiceMock,
            $emailServiceMock,
        );
        
        $emailServiceMock
            ->expects($this->once())
            ->method('send')
            ->with(['name' => 'Amir'],'receipt');

        $customer = ['name' => 'Amir'];
        $amount = 100;

        $result = $invoiceService->process(
            $customer,
            $amount,
        );

        $this->assertTrue($result);
    }
}
