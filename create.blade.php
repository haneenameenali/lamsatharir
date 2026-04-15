<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة منتج جديد - لمسة حرير</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8e1e8; /* خلفية وردية فاتحة */
            color: #333;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #fdb7d4; /* وردي داكن */
            color: white;
            border-radius: 10px 10px 0 0;
        }
        .btn-custom {
            background-color: #fdb7d4;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #f7a1c0;
        }
        .form-control {
            border-radius: 5px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>إضافة منتج جديد - لمسة حرير</h4>
                </div>
                <div class="card-body">
                    <!-- عرض الأخطاء إن وجدت -->
                    <div class="alert alert-danger" style="display: none;" id="error-alert">
                        <ul id="error-list"></ul>
                    </div>

                    <!-- فورم إضافة المنتج -->
                   <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">اسم المنتج</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">السعر</label>
                            <input type="number" class="form-control" id="price" name="price" required>
 </div>
 <div class="mb-3">
<label for="description" class="form-label">وصف المنتج</label>
 <textarea class="form-control" id="description" name="description" rows="4" ></textarea>
</div>
<div class="mb-3">
  <label for="image" class="form-label">صورة المنتج</label>
 <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
</div>

 <button type="submit" class="btn btn-custom w-100">إضافة المنتج</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- إضافة سكربتات جافا سكريبت -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
