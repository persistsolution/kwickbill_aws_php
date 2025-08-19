<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Salary Slip</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background: #f8f8f8;
    }

    .slip-container {
      max-width: 800px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border: 1px solid #000;
    }

    .text-center {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    th, td {
      border: 1px solid #000;
      padding: 8px 12px;
      text-align: left;
    }

    .no-border {
      border: none !important;
    }

    .section-title {
      font-weight: bold;
      background-color: #eaeaea;
    }

    .right {
      text-align: right;
    }

    .print-button {
      margin: 20px 0;
      text-align: right;
    }

    @media print {
      .print-button {
        display: none;
      }
      body {
        background: #fff;
      }
    }
  </style>
</head>
<body>

<div class="slip-container" id="printArea">
  <h2 class="text-center">Salary Slip</h2>
  <p><strong>Employee Name:</strong> John Doe</p>
  <p><strong>Designation:</strong> Software Developer</p>
  <p><strong>Salary Month:</strong> May 2025</p>
  <p><strong>Employee ID:</strong> EMP1234</p>

  <table>
    <thead>
      <tr>
        <th colspan="2">Earnings</th>
        <th colspan="2">Deductions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Basic Salary</td>
        <td class="right">₹30,000</td>
        <td>Professional Tax</td>
        <td class="right">₹200</td>
      </tr>
      <tr>
        <td>HRA</td>
        <td class="right">₹10,000</td>
        <td>PF</td>
        <td class="right">₹1,000</td>
      </tr>
      <tr>
        <td>Convence Allowance</td>
        <td class="right">₹2,000</td>
        <td>Other Deductions</td>
        <td class="right">₹500</td>
      </tr>
      <tr>
        <td>Special Allowance</td>
        <td class="right">₹2,000</td>
        <td></td>
        <td class="right"></td>
      </tr>
      <tr>
        <td></td>
        <td class="right"></td>
        <td>Income Tax</td>
        <td class="right">₹500</td>
      </tr>
      <tr>
        <td></td>
        <td class="right"></td>
        <td>Petty Cash</td>
        <td class="right">₹500</td>
      </tr>
      <tr>
        <td></td>
        <td class="right"></td>
        <td>Advance Deduction</td>
        <td class="right">₹500</td>
      </tr>
      <tr class="section-title">
        <td>Total Earnings</td>
        <td class="right">₹42,000</td>
        <td>Total Deductions</td>
        <td class="right">₹1,700</td>
      </tr>
      <tr class="section-title">
        <td colspan="2"><strong>Net Pay</strong></td>
        <td colspan="2" class="right"><strong>₹40,300</strong></td>
      </tr>
    </tbody>
  </table>

  <p><strong>Date:</strong> 31-May-2025</p>
  <p><strong>Authorized Signature:</strong> _____________________</p>
</div>

<div class="print-button">
  <button onclick="window.print()">🖨️ Print</button>
</div>

</body>
</html>
