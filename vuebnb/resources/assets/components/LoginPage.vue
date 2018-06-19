<template>
    <div class="login-container" id="login">
        <form action="/login" method="post" role="form">
            <input type="hidden" name="_token" :value="csrf_token">
            <div class="form-control">
                <input type="email" id="email" name="email" placeholder="Email Address" required autofocus>
            </div>
            <div class="form-control">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-control">
                <button type="submit">Log in</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "LoginPage",
        data() {
            return {
                csrf_token: window.csrf_token
            }
        }
    }
</script>

<style lang="scss">
    #login {
        form {
            padding-top: 40px;
        }

        .form-control {
            margin-bottom: 1em;
        }

        input[type="email"],
        input[type="password"],
        button,
        label {
            width: 100%;
            font-size: 19px !important;
            line-height: 24px;
            color: #484848;
            font-weight: 300;
        }

        input {
            background-color: transparent;
            padding: 11px;
            border: 1px solid #dbdbdb;
            border-radius: 2px;
            box-sizing: border-box;
        }

        button {
            background-color: #4fc08d;
            color: #fff;
            cursor: pointer;
            border: #4fc08d;
            border-radius: 4px;
            padding-top: 12px;
            padding-bottom: 12px;
        }
    }

    @media (min-width: 744px) {
        #login form {
            padding-top: 80px;
        }
    }
</style>