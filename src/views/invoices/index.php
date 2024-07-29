<style>
    table {
        width: 100%;
        border-collapse: collapse;
        text-align: center;
    }

    table tr th,
    table tr td {
        border: 1px #eee solid;
        padding: 5px;
    }

    
    .color-green {
        color: green;
    }    

    .color-red {
        color: red;
    }    

    .color-gray {
        color: gray;
    }    

    .color-blue {
        color: blue;
    }    

    .color-black {
        color: black;
    }

</style>
<table>
    <thead>
        <tr>
            <th>Invoices #</th>
            <th>Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= number_format($invoice['invoice_number']) ?></td>
                <td><?= $invoice['amount'] ?></td>
                <td class="<?= \App\Enums\InvoiceStatus::tryFrom($invoice['status'])->color()->getClass() ?>"><?= \App\Enums\InvoiceStatus::tryFrom($invoice['status'])->name ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>