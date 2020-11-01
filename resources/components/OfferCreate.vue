<template>
    <div class="mt-2">
        <form action="admin.offer.store" method="post">
            <div class="row">
                <div class="col">
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" class="form-control" placeholder="name">
                </div>
                <div class="col">
                    <label for="name">Slug</label>
                    <input id="slug" type="text" name="name" class="form-control" placeholder="name">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="start_date">Start Date</label>
                    <input id="start_date" type="date" name="start_date" class="form-control">
                </div>
                <div class="col">
                    <label for="end_date">End Date</label>
                    <input id="end_date" type="date" name="end_date" class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <label for="type">Type of discount</label>
                    <select id="type" class="form-control">
                        <option value="create">Discount percent off</option>
                        <option value="create">Discount amount off</option>
                        <option value="create">Fixed amount</option>
                    </select>
                </div>
                <div class="col">
                    <label for="amount">Discount amount</label>
                    <input id="amount" type="number" name="amount" class="form-control">
                </div>
            </div>
            <!--<avored-select-->
                <!--label-text="{{ __('avored::system.fields.category') }}"-->
                <!--field-name="category[]"-->
                <!--:multiple=true-->
                <!--v-model="f"-->
                <!--error-text="{{ $errors->first('category') }}"-->
                <!--:options="{{ json_encode($categoryOptions) }}"-->
            <!--&gt;-->
            <!--</avored-select>-->
            <button type="submit" class="btn mt-4 btn-danger">Save</button>
        </form>
    </div>
</template>
<script>
    export default {
        props: [],
        data () {
            return {
            };
        },
        methods: {
        },
        mounted() {
            console.log("abc");
        }
    };
</script>