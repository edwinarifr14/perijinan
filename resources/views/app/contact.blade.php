@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<section class="contact_area section_gap_bottom">
    <div class="container">
        <div style="margin:50px 0px;">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.3774298314465!2d113.71488451406564!3d-8.164675784070887!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd694351d727e69%3A0xec33c34804a10832!2sUniversitas%20Jember!5e0!3m2!1sid!2sid!4v1569656448859!5m2!1sid!2sid" frameborder="0" style="height:500px;width:100%;border:0" allowfullscreen></iframe>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="lnr lnr-home"></i>
                        <h6>Jember, Indonesia</h6>
                        <p>Jl. Kalimantan, Sumbersari, Jember, Jawa Timur 68121</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-phone-handset"></i>
                        <h6><a href="tel:+62899999999">+62 80000000000</a></h6>
                        <p>Buka: 08:00 s/d 17:00</p>
                    </div>
                    <div class="info_item">
                        <i class="lnr lnr-envelope"></i>
                        <h6><a href="mailto:taniku@gmail.com">taniku@gmail.com</a></h6>
                        <p>Hubungi kami jika ada yang ditanyakan!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" rows="1" placeholder="Enter Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" value="submit" class="primary-btn">Kirim Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
