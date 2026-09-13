@extends('app')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}" class="text-decoration-none text-muted-green">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ url('instruction') }}" class="text-decoration-none text-muted">Instruction</a></li>
@endsection
@section('content')
<head>
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
            background: #e8f1ff;
            color: #2563eb;
            border-radius: 14px;
            font-size: 26px;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
            color: #1e3a8a;
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
            background: #eff6ff;
            transform: translateX(4px);
        }

        .number {
            min-width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #2563eb;
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
            color: #1d4ed8;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div >
            <div class="header">
                <div class="icon">👤</div>
                <div>
                    <h1>Admin</h1>
                    <p>Tata cara penggunaan aplikasi POS</p>
                </div>
            </div>

            <div class="steps">

                <div class="step">
                    <div class="number">1</div>
                    <p>Login ke dalam aplikasi POS menggunakan akun <strong>Admin</strong>.</p>
                </div>

                <div class="step">
                    <div class="number">2</div>
                    <p>Pilih menu <strong>User</strong> untuk menambah, mengubah, atau menghapus data pengguna.</p>
                </div>

                <div class="step">
                    <div class="number">3</div>
                    <p>Pilih menu <strong>Produk</strong> untuk menambah, mengubah, atau menghapus data produk.</p>
                </div>

                <div class="step">
                    <div class="number">4</div>
                    <p>Pilih menu <strong>Kategori Produk</strong> untuk menambah, mengubah, atau menghapus kategori produk.</p>
                </div>

                <div class="step">
                    <div class="number">5</div>
                    <p>Pastikan seluruh data yang dimasukkan sudah sesuai.</p>
                </div>

            </div>

        </div>

    </div>

</body>
@endsection