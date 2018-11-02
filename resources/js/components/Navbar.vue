<template>

        <nav :title="title" class="navbar navbar-expand navbar-light">
            <a class="navbar-brand" href="#" :title="subTitle">{{ title }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample02">
                <form class="form-inline my-2 my-md-0">
                    <input class="form-control" type="text" placeholder="Search">
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">My Boards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
            </div>
        </nav>
</template>

<script>

    export default {
        name: 'Navbar',
        props: {
            title: String,
        },
        data() {
            return {
                subTitle: "Always better when It's simple",
            }
        }
    }

</script>

<style scoped>

</style>