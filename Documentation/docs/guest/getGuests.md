# Get Guests

Get a list of all Guests. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/guest/read.php</span>

---

## Description

This endpoint returns all Guests stored in the database.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "data": [
        {
            "guest_id": 12,
            "wedding_plan_id": 19,
            "guest_email": "jvella@gmail.com",
            "guest_name": "John",
            "guest_surname": "Vella",
            "rsvp_status": "pending",
            "guest_category": "Friends"
        },
        {
            "guest_id": 7,
            "wedding_plan_id": 17,
            "guest_email": "kborg@gmail.com",
            "guest_name": "Keith",
            "guest_surname": "Borg",
            "rsvp_status": "pending",
            "guest_category": "Family of the Groom"
        },
        {
            "guest_id": 9,
            "wedding_plan_id": 17,
            "guest_email": "kfarrugia@gmail.com",
            "guest_name": "Kim",
            "guest_surname": "Farrugia",
            "rsvp_status": "pending",
            "guest_category": "Friends"
        },
        {
            "guest_id": 10,
            "wedding_plan_id": 17,
            "guest_email": "mvella@gmail.com",
            "guest_name": "Martina",
            "guest_surname": "Vella",
            "rsvp_status": "pending",
            "guest_category": "Work Friends"
        },
        {
            "guest_id": 5,
            "wedding_plan_id": 17,
            "guest_email": "mcassar@gmail.com",
            "guest_name": "Mary",
            "guest_surname": "Cassar",
            "rsvp_status": "pending",
            "guest_category": "Family of the Bride"
        },
        {
            "guest_id": 13,
            "wedding_plan_id": 21,
            "guest_email": "maryhili@gmail.com",
            "guest_name": "Mary",
            "guest_surname": "Hili",
            "rsvp_status": "pending",
            "guest_category": "Family of the Bride"
        },
        {
            "guest_id": 14,
            "wedding_plan_id": 28,
            "guest_email": "kparascandalo@gmail.com",
            "guest_name": "Mary",
            "guest_surname": "Vella",
            "rsvp_status": "pending",
            "guest_category": "Friends"
        },
        {
            "guest_id": 11,
            "wedding_plan_id": 19,
            "guest_email": "rcassar@gmail.com",
            "guest_name": "Ruth",
            "guest_surname": "Cassar",
            "rsvp_status": "pending",
            "guest_category": "Family of the Bride"
        },
        {
            "guest_id": 6,
            "wedding_plan_id": 17,
            "guest_email": "shili@gmail.com",
            "guest_name": "Sandra",
            "guest_surname": "Hili",
            "rsvp_status": "pending",
            "guest_category": "Family of the Bride"
        },
        {
            "guest_id": 8,
            "wedding_plan_id": 17,
            "guest_email": "tvella@gmail.com",
            "guest_name": "Tom",
            "guest_surname": "Vella",
            "rsvp_status": "pending",
            "guest_category": "Family of the Groom"
        }
    ]
}
```

---

### <span class="json">404 Not Found</span>

No Guests were found.

```json
{
    "message": "Guests not found."
}
```