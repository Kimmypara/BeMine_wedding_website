# Update Vendor  

Update Vendor. 

## Request Body

```json
{
    "vendor_id": "15",
    "vendor_name":"Golden Horizon Venue",
    "category_id":"7",
    "user_id":"11",
    "images": [
    "assets/vendor_images/GoldenHorizonVenue1.jpg",
    "assets/vendor_images/GoldenHorizonVenue2.jpg",
    "assets/vendor_images/GoldenHorizonVenue3.jpg"
   
  ],
    "locations":"Mellieha",
    "basic_info":"We believe every love story deserves a beautiful setting. Our venue offers romantic gardens, elegant spaces, and personalised service to help create unforgettable wedding memories.",
    "min_price":"6000"
   
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/vendor/update.php</span>

### Body <span class="json">application/json</span>

<span class="box">vendor_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The vendor_id must be existing. 

<span class="box">vendor_name</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The vendor name must be unique. 

<span class="box">category_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The category_id must be existing. 

<span class="box">user_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The user_id must be existing.

<span class="box">images</span>
<span class="endpoint-box">array</span>
<span class="endpoint-box">Required</span>

The images field must contain one or more image paths or image URLs related to the vendor.  
Each image should be provided as a string inside the array.

<span class="box">locations</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The location does not have to be unique.

<span class="box">basic_info</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

The Basic info should not exceed 500 characters.

<span class="box">min_price</span>
<span class="endpoint-box">decimal</span>
<span class="endpoint-box">Required</span>

The Minimum price can be decimal number with up to 10 digits in total and 2 decimal places. 


---

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so vendor was updated.

```json
{
    "message": "Vendor updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Vendor not updated. Missing or invalid input."
}
```

Possible validation errors:

```json
{
    "message": "Invalid or missing JSON body."
}
```

---

### <span class="json">401 Unauthorized</span>

Unauthorized.

```json
{
    "message": "Unauthorized."
}
```

---

### <span class="json">403 Forbidden</span>

Only administrators can update vendors.

```json
{
    "message": "Access denied. Admin only."
}
```

---

### <span class="json">409 Conflict</span>

The vendor already exists.

```json
{
    "message": "Vendor not updated. Vendor already exists."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to update the Vendor.

```json
{
    "message": "Server error."
}
``` 