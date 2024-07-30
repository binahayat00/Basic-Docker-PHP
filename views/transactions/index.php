<h1 class="center" style="text-align: center;margin:10px">Transactions</h1>
<table class="center">

    <th>ID</th>
    <th>Date</th>
    <th>Checks</th>
    <th>Descriptions</th>
    <th>Amount</th>

    <?php foreach ($transactions as $transaction): ?>
        <tr>
            <td><?php echo $transaction['id'] ?></td>
            <td><?php echo $transaction['created_at'] ?? '-' ?></td>
            <td><?php echo $transaction['checks'] ?? '-' ?></td>
            <td><?php echo $transaction['descriptions'] ?? '-' ?></td>
            <?php if ($transaction['amount'] >= 0): ?>
                <td class="amount-positive"><?php echo $transaction['amount'] ?? '-' ?></td>
            <?php else: ?>
                <td class="amount-negative"><?php echo $transaction['amount'] ?? '-' ?></td>
            <?php endif; ?>

        </tr>
    <?php endforeach; ?>
</table>

<style>
    table {
        position: absolute;
        top: 50px;
        bottom: 50px;
        left: 20px;
        right: 20px;
        width: 95%;
        text-align: center;
    }

    table,
    th,
    td {
        border: 1px solid white;
        border-collapse: collapse;
    }

    th,
    td {
        background-color: #96D4D4;
        height: 100%;
    }

    .center {
        margin-left: auto;
        margin-right: auto;
    }

    .amount-positive {
        color: green;
    }

    .amount-negative {
        color: red;
    }
</style>