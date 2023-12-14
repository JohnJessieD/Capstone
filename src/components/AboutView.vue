<template>
  <div>
    
    <div class="tea-image">
      <img src="/img/malay_dynastea.png" alt="Malay Dynastea" class="image-hover" />

    </div>

    <!-- E-commerce Form with Box Shadow -->
    <div class="ecommerce-form">
      <h2 style="background-color: #F1C27B;">Order Your Favorite Teas</h2>
      <!-- Your e-commerce form content goes here -->
      <!-- Include input fields for name, address, tea selection, etc. -->
    </div>

    <!-- Location and Contact Information -->
    <div class="location">
      <h2>Visit Us</h2>
      <!-- Google Map Embed with Box Shadow -->
      <div class="google-map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.623701805567!2d121.18907911427388!3d13.412695990510984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339648f29999aa79%3A0xc4db9a550df2d2f5!2sLumangbayan%2C%20Calapan%20City%2C%20Oriental%20Mindoro!5e0!3m2!1sen!2sph!4v1665975691950!5m2!1sen!2sph"
          width="100%"
          height="300"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          class="map-shadow"
        ></iframe>
      </div>

      <!-- Contact Information with Icons -->
      <div class="contact">
        <p class="contact-item"><i class="fas fa-map-marker-alt"></i> Lumangbayan, Calapan City, Oriental Mindoro</p>
        <p class="contact-item"><i class="fas fa-phone-alt"></i> +0912 741 9447</p>
        <p class="contact-item"><i class="far fa-envelope"></i> @malaydynastea.com</p>
        <p></p>
      </div>
    </div>
  </div>
</template>

<script>


export default {


 
};
</script>

<style scoped>

.about-heading {
  font-size: 32px;
  color: #333;
  margin-bottom: 20px;
  text-align: center;
}

.tea-image img {
  width: 100%;
  max-height: 400px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 10px;
  transition: transform 0.3s ease-in-out;
}

.tea-image img:hover {
  transform: scale(1.1);
}

.ecommerce-form {
  margin-bottom: 10px;
  text-align: center;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  padding: 20px;
  border-radius: 8px;
}

.location {
  margin-top: 10px; /* Adjust or set to 0 */
  font-size: 1.2rem;
}

.google-map {
  margin-bottom: 20px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

.map-shadow {
  border-radius: 8px;
}

.contact {
  margin-top: 10px;
  text-align: center;
}

.contact-item {
  margin-bottom: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.contact-item i {
  margin-right: 8px;
}

.contact-item i {
  margin-right: 8px;
  color: #007BFF;
}
</style>
