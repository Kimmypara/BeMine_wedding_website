# Update If Task is Selected

Update the wedding task if selected.

## Request Body

```json
{
    "wedding_plan_task_id": "64",
    "is_selected": "1"
}
```

## Request 

<span class="box1">PATCH</span>
<span class="endpoint-box1">/wedding_plan_task/updateIsSelected.php</span>

### Body <span class="json">application/json</span>

<span class="box">wedding_plan_task_id</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

The wedding_plwedding_plan_task_idan_id must be existing.  

<span class="box">is_selected</span>
<span class="endpoint-box">int</span>
<span class="endpoint-box">Required</span>

Determines whether the wedding task is selected. Is Selected must be:
```
0 = Inactive
1 = Active
```

## Responses

### <span class="json">200 OK Updated</span>

The request worked, so Wedding Plan Task was updated.

```json
{
    "message": "Wedding Plan Task updated."
}
```

---

### <span class="json">400 Bad Request</span>

The request has missing or invalid input.

```json
{
    "message": "Wedding Plan Task not updated. Missing or invalid input."
}
```

Possible validation errors:

```json
{
    "message": "Invalid Is Selected value. Use 0 or 1 only."
}
```

### <span class="json">404 Not Found</span>

The wedding_plan_task_id is not found.

```json
{
    "message": "Wedding Plan Task Id not found."
}
```
---

### <span class="json">500 Server Error</span>

The server failed to update the wedding plan task.

```json
{
    "message": "Server error."
}
``` 