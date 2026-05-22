# Update Wedding Plan

Update Wedding Plan for the couple.

## Request Body

```json
{
    "wedding_plan_id":"4",
    "user_id":"2",
    "user_nickname":"Kitty",
    "partner_nickname":"Mike",
    "wedding_date":"2028-01-03",
    "guest_count":"300",
    "budget":"100000.50"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/wedding_plan/update.php</span>

### Body <span class="json">application/json</span>

<span class="box">wedding_plan_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The wedding_plan_id must be existing. 


<span class="box">user_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The user_id must be existing. 

<span class="box">user_nickname</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Nickname of user does not have to be unique.

<span class="box">partner_nickname</span>
<span class="endpoint-box">String</span>
<span class="endpoint-box">Required</span>

Partner Nickname does not have to be unique.

<span class="box">wedding_date</span>
<span class="endpoint-box">Date</span>
<span class="endpoint-box">Required</span>

The date format should be:
```
 "yyyy/mm/dd"

```
<span class="box">guest_count</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The guest count must be whole number. 

<span class="box">budget</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The budget can be a decimal number.

---

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so wedding plan was updated.

```json
{
    "message": "Wedding Plan updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Wedding Plan not updated. Missing or invalid input."
}
```

Possible validation errors:

```json
{
    "message": "Invalid wedding date format. Use YYYY-MM-DD."
}
```

```json
{
    "message": "Invalid Budget format."
}
```

```json
{
    "message": "Invalid guest count."
}
```

---

### <span class="json">404 Not Found</span>

The wedding_plan_id is not found.

```json
{
    "message": "Wedding Plan ID not found."
}
```

---

### <span class="json">500 Server Error</span>

The server failed to update the wedding plan.

```json
{
    "message": "Server error."
}
``` 