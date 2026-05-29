# Get Tasks 

Get a list of all Tasks. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/task/read.php</span>

---

## Description

This endpoint returns all Tasks stored in the database.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "data": [
        {
            "task_id": 3,
            "category_id": 1,
            "task_name": "booking"
        },
        {
            "task_id": 4,
            "category_id": 1,
            "task_name": "quotation"
        }
    ]
}
```

---

### <span class="json">404 Not Found</span>

No Tasks were found.

```json
{
    "message": "Tasks not found."
}
```