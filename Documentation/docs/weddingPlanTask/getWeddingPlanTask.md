# Get Wedding Plan Tasks

Get a list of all Wedding Plan Tasks. 

## Request 

<span class="box1">GET</span>
<span class="endpoint-box1">/wedding_plan_task/read.php</span>

---

## Description

This endpoint returns all Wedding Plan Tasks stored in the database.

---

## Response

### <span class="json">200 OK</span>

```json
{
    "data": [
        {
            "wedding_plan_task_id": 334,
            "wedding_plan_id": 27,
            "task_id": null,
            "is_selected": 1,
            "is_completed": 0,
            "category_id": 21
        },
        {
            "wedding_plan_task_id": 333,
            "wedding_plan_id": 27,
            "task_id": null,
            "is_selected": 1,
            "is_completed": 0,
            "category_id": 6
        }
    ]
}
```

---

### <span class="json">404 Not Found</span>

No Wedding Plan Tasks were found.

```json
{
    "message": "Wedding plan task not found."
}
```