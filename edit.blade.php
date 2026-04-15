<!-- resources/views/admin/products/edit.blade.php -->
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المنتج</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8e1e8; /* وردي فاتح */
            color: #333;
            direction: rtl; /* الكتابة من اليمين لليسار */
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 15px;
            border: 1px solid #fdb7d4;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #fdb7d4; /* وردي داكن */
            color: white;
            border-radius: 15px 15px 0 0;
            text-align: center;
            padding: 15px;
        }
        .card-body {
            background-color: white;
            padding: 30px;
            border-radius: 0 0 15px 15px;
        }
        .form-group label {
            color: #f56c8c;
            font-weight: bold;
        }
        .btn-custom {
            background-color: #fdb7d4;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #f7a1c0;
        }
        .btn-cancel {
            background-color: #fdb7d4; /* اللون الوردي */
            color: white;
            border: none;
        }
        .btn-cancel:hover {
            background-color: #f7a1c0; /* اللون الوردي الداكن عند التحويم */
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #fdb7d4;
        }
        .img-thumbnail {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .mb-3 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>تعديل المنتج</h4>
                </div>
                <div class="card-body">
                    <!-- عرض رسالة النجاح إذا كانت موجودة -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- حقل اسم المنتج -->
                        <div class="form-group mb-3">
                            <label for="name">اسم المنتج</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                        </div>

                        <!-- حقل السعر -->
                        <div class="form-group mb-3">
                            <label for="price">السعر</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                        </div>

                        <!-- حقل الوصف -->
                        <div class="form-group mb-3">
                            <label for="description">الوصف</label>
                            <textarea class="form-control" id="description" name="description" >{{ $product->description }}</textarea>
                        </div>

                        <!-- حقل الصورة -->
                        <div class="form-group mb-3">
                            <label for="image">الصورة</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <small class="form-text text-muted">اختياري: يمكنك تحميل صورة جديدة أو تركها كما هي.</small>

                            <!-- عرض الصورة الحالية -->
                            @if ($product->image)
                                <div class="mt-3">
                                    <label>الصورة الحالية:</label>
                                    <img src="{{ asset('images/' . $product->image) }}" class="img-thumbnail" alt="صورة المنتج">
                                </div>
                            @endif
                        </div>

                        <!-- زر التحديث -->
                        <button type="submit" class="btn btn-custom mt-3">تحديث المنتج</button>
                        
                        <!-- زر الإلغاء -->
                        <a href="{{ route('admin.products.index') }}" class="btn btn-cancel mt-3 ml-3">إلغاء</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>