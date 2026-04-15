<div class="container my-4" dir="rtl">

<style>

/* الصفحة */
.container{
    display:flex;
    flex-direction:column;
    align-items:center;
}

/* زر الرجوع */
.top-bar{
    width:70%;
    display:flex;
    justify-content:flex-start;
    margin-bottom:10px;
}

.back{
    background:linear-gradient(90deg,#ff4da6,#ff1493);
    color:white;
    border:none;
    padding:8px 18px;
    border-radius:25px;
    font-weight:bold;
}

/* العنوان */
.title{
    text-align:center;
    color:#d81b60;
    font-weight:bold;
    margin-bottom:15px;
}

/* الجدول */
.table-box{
    width:70%;
    background:#fff;
    border:2px solid #ffc0cb;
    border-radius:15px;
    padding:10px;
    box-shadow:0 2px 10px rgba(0,0,0,0.06);
}

.table-cart{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

.table-cart th{
    background:linear-gradient(90deg,#ff4da6,#ff1493);
    color:white;
    padding:8px;
}

.table-cart td{
    padding:8px;
    text-align:center;
    border-bottom:1px solid #eee;
}

.table-cart img{
    width:55px;
    height:55px;
    object-fit:cover;
    border-radius:10px;
    border:1px solid #eee;
}

/* زر حذف */
.delete-btn{
    background:#ff1493;
    color:white;
    border:none;
    padding:6px 10px;
    border-radius:20px;
    font-size:12px;
}

/* الإجمالي */
.total-box{
    margin-top:12px;
    text-align:center;
    font-size:18px;
    font-weight:bold;
    color:#ff1493;
}

/* صندوق التواصل */
.form-box{
    width:40%;
    margin-top:20px;
    background:#fff;
    border:2px solid #ffc0cb;
    border-radius:15px;
    padding:15px;
    box-shadow:0 2px 10px rgba(0,0,0,0.06);
}

.form-title{
    text-align:center;
    font-weight:bold;
    color:#d81b60;
    margin-bottom:10px;
}

input, select{
    width:100%;
    padding:8px;
    border-radius:10px;
    border:1px solid #ddd;
    margin-top:5px;
    text-align:center;
    font-size:13px;
}

/* زر واتساب */
.whatsapp{
    width:160px;
    display:block;
    margin:12px auto;
    padding:6px 10px;
    border:none;
    border-radius:18px;
    background:linear-gradient(90deg,#ff4da6,#ff1493);
    color:white;
    font-weight:bold;
    font-size:12px;
    cursor:pointer;
    text-align:center;
}

/* فارغ */
.empty{
    background:#ffe4ec;
    padding:15px;
    text-align:center;
    border-radius:12px;
    color:#c2185b;
    width:60%;
}

/* موبايل */
@media (max-width:768px){

    .table-box{
        width:95%;
    }

    .form-box{
        width:90%;
    }

    .top-bar{
        width:95%;
    }

    .empty{
        width:90%;
    }
}

</style>

<!-- زر الرجوع -->
<div class="top-bar">
    <button class="back" onclick="goHome()">⬅ العودة للمتجر</button>
</div>

<!-- العنوان -->
<h3 class="title">سلة المشتريات 🛍</h3>

@if(session('cart') && count(session('cart')) > 0)

@php $total = 0; @endphp

<div class="table-box">

<table class="table-cart">

<thead>
<tr>
    <th>الصورة</th>
    <th>المنتج</th>
    <th>السعر</th>
    <th>الكمية</th>
    <th>المجموع</th>
    <th>إجراء</th>
</tr>
</thead>

<tbody>

@foreach(session('cart') as $id => $item)

@php 
$subtotal = $item['price'] * $item['quantity'];
$total += $subtotal;
@endphp

<tr>

    <td>
        <img src="{{ asset('images/' . $item['image']) }}">
    </td>

    <td>{{ $item['name'] }}</td>

    <td style="color:#ff1493;">
        {{ rtrim(rtrim(number_format($item['price'], 2, '.', ''), '0'), '.') }} ريال
    </td>

    <td>{{ intval($item['quantity']) }}</td>

    <td style="color:#c2185b;font-weight:bold;">
        {{ rtrim(rtrim(number_format($subtotal, 2, '.', ''), '0'), '.') }} ريال
    </td>

    <td>
        <form action="{{ route('cart.remove', $id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button class="delete-btn">
                إلغاء طلب المنتج
            </button>
        </form>
    </td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="total-box">
    الإجمالي الكلي: {{ rtrim(rtrim(number_format($total, 2, '.', ''), '0'), '.') }} ريال
</div>

<!-- بيانات التواصل -->
<div class="form-box">

    <div class="form-title"> بيانات التواصل 🌸</div>

    <label>اسمك</label>
    <input type="text" id="customer_name">

    <label>طريقة الدفع</label>
    <select id="payment_method">
        <option value="cash">الدفع عند الاستلام 🌸</option>
        <option value="kuraimi">تحويل كريمي (3174328028)</option>
        <option value="point">نقطة حاسب (1701913)</option>
    </select>

    <button class="whatsapp" onclick="sendToWhatsApp()">
        إرسال عبر واتساب 🌸
    </button>

</div>

@else

<div class="empty">
    السلة فارغة حالياً 💕
</div>

@endif

</div>

<script>

let cart = @json(session('cart') ?? []);

function goHome(){
    window.location.href = "{{ url('/') }}";
}

/* 🔥 واتساب مع الكمية */
function sendToWhatsApp(){

    let name = document.getElementById('customer_name').value;
    let payment = document.getElementById('payment_method').value;

    if(name.trim() === ""){
        alert("اكتب اسمك");
        return;
    }

    let paymentText = "";
    if(payment === "cash"){
        paymentText = "الدفع عند الاستلام 🌸";
    } else if(payment === "kuraimi"){
        paymentText = "تحويل كريمي (3174328028)";
    } else {
        paymentText = "نقطة حاسب (1701913)";
    }

    let msg = "🛍 طلب جديد\n\n";
    msg += "👤 الاسم: " + name + "\n";
    msg += "💳 طريقة الدفع: " + paymentText + "\n\n";
    msg += "📦 المنتجات المطلوبة:\n";

    let total = 0;

    Object.values(cart).forEach(item=>{
        let sub = item.price * item.quantity;
        total += sub;

        // 🔥 الكمية مضافة هنا
        msg += "- " + item.name +
               " (الكمية: " + item.quantity + ")" +
               " = " + sub + " ريال\n";
    });

    msg += "\n💰 الإجمالي: " + total + " ريال\n\n";
    msg += "🙏 يرجى تأكيد الطلب";

    let phone = "782729297";

    window.open("https://wa.me/" + phone + "?text=" + encodeURIComponent(msg), "_blank");
}

</script>