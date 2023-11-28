<section class="exit-intent-popup-admin">
  <h1>Exit Intent Popup</h1>

  <p class="js-loading-msg">Loading information from database...</p>

  <form class="popup-form" id="popup-form" method="POST">
    <div class="form-group">
      <label for="popup-subhead">Subhead</label>
      <input type="text" id="popup-subhead" placeholder="Subhead">
    </div>
    
    <div class="form-group">
      <label for="popup-title">Title</label>
      <input type="text" id="popup-title" placeholder="Title">
    </div>

    <div class="form-group">
      <label for="popup-content">Content</label>
      <textarea rows="4" id="popup-content" placeholder="Content here"></textarea>
    </div>

    <div class="form-group">
      <label for="popup-image">Image Url</label>
      <input type="text" id="popup-image" placeholder="https://image-url.com/image.jpg">
    </div>

    <p class="alert-error" style="display: none"></p>

    <p class="alert-success" style="display: none"></p>

    <button class="form-btn">Save</button>
  </form>
</section>