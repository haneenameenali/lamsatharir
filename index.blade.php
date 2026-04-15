<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منتجات لمسة حرير</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8e1e8; /* خلفية وردية فاتحة */
            color: #333;
            direction: rtl; /* الكتابة من اليمين لليسار */
        }
        .container {
            margin-top: 50px;
        }
        .card-header {
            background-color: #fdb7d4; /* وردي داكن */
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .table thead {
            background-color: #fdb7d4; /* خلفية رأس الجدول */
            color: white;
        }
        .table td, .table th {
            vertical-align: middle;
            text-align: center;
        }
        .table td.description-column {
            width: 300px; /* تكبير حقل الوصف */
            word-wrap: break-word; /* تكسير الكلمات الطويلة في الوصف */
        }
        .btn-custom {
            background-color: #fdb7d4;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #f7a1c0;
        }
        .img-thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">
                    <h4>منتجات لمسة حرير</h4>
                </div>
                <div class="card-body">
                    <!-- عرض رسالة النجاح إذا كانت موجودة -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- جدول عرض المنتجات -->
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>اسم المنتج</th>
                                <th>السعر</th>
                                <th>الوصف</th>
                                <th>الصورة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ (int) $product->price }}</td>
                                    <td class="description-column">
                                        {{ $product->description ?? 'لا يوجد وصف' }}
                                    </td>

                                    <td>
                                        <!-- عرض الصورة المخزنة في الحقل image -->
                                        @if($product->image)
                                            <img src="{{ asset('images/'.$product->image) }}" class="img-thumbnail" alt="صورة المنتج">
                                        @else
                                            <span>لا توجد صورة</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- زر إضافة منتج جديد -->
                    <div class="text-center mt-3">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-custom">إضافة منتج جديد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>