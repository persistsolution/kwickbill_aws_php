<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Summary Doughnut Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
    }
    canvas {
      max-width: 400px;
      margin: 20px auto;
    }
  </style>
</head>
<body>

<h2>Income vs Expenses</h2>
<canvas id="summaryChart"></canvas>

<?php
// Dummy sample values (replace with real sums from your app)
$totalSaleAll = 250000;
$empExpensesAll = 30000;
$vendorExpensesAll = 25000;
$nsoExpensesAll = 10000;
$balanceAll = $totalSaleAll - ($empExpensesAll + $vendorExpensesAll + $nsoExpensesAll);
?>

<script>
const ctx = document.getElementById('summaryChart').getContext('2d');
const chart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [
      'Total Sale',
      'Employee Expenses',
      'Vendor Expenses',
      'NSO Vendor Expenses',
      'Balance'
    ],
    datasets: [{
      data: [
        <?= $totalSaleAll ?>,
        <?= $empExpensesAll ?>,
        <?= $vendorExpensesAll ?>,
        <?= $nsoExpensesAll ?>,
        <?= $balanceAll ?>
      ],
      backgroundColor: [
        '#36A2EB',
        '#FF6384',
        '#FFCE56',
        '#9966FF',
        '#4BC0C0'
      ]
    }]
  },
  options: {
    cutout: '70%',
    plugins: {
      legend: {
        position: 'bottom'
      },
      tooltip: {
        callbacks: {
          label: (ctx) => `${ctx.label}: ₹${ctx.raw.toLocaleString()}`
        }
      }
    }
  },
  plugins: [{
    id: 'centerText',
    beforeDraw(chart) {
      const { width, height, ctx } = chart;
      ctx.restore();
      const total = <?= $totalSaleAll ?>;
      const title = 'Total Sale';
      const text = '₹' + total.toLocaleString();

      ctx.font = '16px Arial';
      ctx.fillStyle = '#333';
      ctx.textAlign = 'center';
      ctx.fillText(title, width / 2, height / 2 - 10);

      ctx.font = 'bold 20px Arial';
      ctx.fillStyle = '#000';
      ctx.fillText(text, width / 2, height / 2 + 20);
      ctx.save();
    }
  }]
});
</script>

</body>
</html>
