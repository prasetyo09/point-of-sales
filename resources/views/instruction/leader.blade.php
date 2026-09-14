@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('/instruction/leader') }}" class="text-decoration-none text-muted">Instruction</a></li>
@endsection
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tata Cara Leader</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        .container {
            max-width: 850px;
            margin: 50px auto;
            padding: 20px;
        }

        .guide-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .icon {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0ebff;
            color: #7c3aed;
            border-radius: 14px;
            font-size: 26px;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
            color: #5b21b6;
        }

        .header p {
            margin: 5px 0 0;
            color: #6b7280;
            font-size: 14px;
        }

        .steps {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .step {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 16px;
            border-radius: 12px;
            background: #f8fafc;
            transition: 0.2s;
        }

        .step:hover {
            background: #f5f3ff;
            transform: translateX(4px);
        }

        .number {
            min-width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #7c3aed;
            color: white;
            border-radius: 50%;
            font-weight: bold;
        }

        .step p {
            margin: 7px 0 0;
            line-height: 1.6;
            font-size: 15px;
        }

        strong {
            color: #6d28d9;
        }
    </style>
</head>

<body>

<div class="container-fluid">

    <div>

        <div class="header">
            <div class="icon">📊</div>
            <div>
                <h1>Leader</h1>
                <p>Procedures for using the POS application</p>
            </div>
        </div>

        <div class="steps">

            <div class="step">
                <div class="number">1</div>
                <p>Log in to the POS application using an <strong>Leader</strong> account.</p>
            </div>

            <div class="step">
                <div class="number">2</div>
                <p>Select the <strong>Products</strong> menu to view the stock.</p>
            </div>

            <div class="step">
                <div class="number">3</div>
                <p>Check the available stock quantity of the product.</p>
            </div>

            <div class="step">
                <div class="number">4</div>
                <p>Select the Sales <strong>Reports</strong> menu to view the sales transaction report.</p>
            </div>

            <div class="step">
                <div class="number">5</div>
                <p>Select the report period you wish to view.</p>
            </div>

            <div class="step">
                <div class="number">6</div>
                <p>Check the transaction information and sales results in the report.</p>
            </div>

        </div>

    </div>

</div>

</body>
@endsection
