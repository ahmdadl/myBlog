<div class="bg-dark border text-danger rounded text-lg p-3 my-2 shadow"
    v-if='post'>
    <div>
        <h6 class="text-info">Add new Task</h6>
        <form class="form form-inline needs-validation"
            :class="{'was-validated': newTaskError}" method="POST"
            @submit.stop.prevent='saveTask(post.slug)' novalidate>
            <div class="form-group col-10">
                <input type="text" v-model="newTask" id="newTask"
                    class="form-control" placeholder="task body"
                    aria-describedby="newTaskHelp" minlength="5" maxlength="70"
                    required>
                <span id="newTaskHelp" class="invalid-feedback"
                    v-if='taskBodyError' v-text='taskBodyError'></span>
            </div>
            <div class="form-group col-2">
                <span v-if="taskSaving">
                    <span class="spinner-border spinner-border-sm text-success"
                        role="status" aria-hidden="true"></span>
                </span>
            </div>
        </form>
    </div>

    <form method="POST" class="form" v-for="(task, indx) in post.tasks">

        <div class="form-check form-check-inline">
            <label class="form-check-label checkable"
                v-on:click.stop='checkTask(post.slug, task.id, indx)'
                :class="{'checked': task.done}">
                <input class="form-check-input" type="checkbox" :ref='task.id'
                    id="task.id" :value="task.id" :checked='task.done'
                    v-on:click.stop />
                <span class="d-none" :ref='"spinner" + task.id'>
                    <span class="spinner-border spinner-border-sm text-info"
                        role="status" aria-hidden="true"></span>
                </span>
                @{{task.body}}
            </label>
        </div>
    </form>
</div>