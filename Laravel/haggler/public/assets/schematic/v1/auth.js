var page = [

    {
        title: 'Login',
        description: 'Login sample request',
        action: '/auth/login',
        method: 'post',
        data: [
            {
                type: 'username',
                name: 'username',
                description: 'Enter your username',
                param_type: 'form',
                required: true
            },
            {
                type: 'password',
                name: 'password',
                description: 'Enter your password',
                param_type: 'form',
                required: true
            }


        ]
    },

     {
        title: 'Logout',
        description: 'Logout sample request',
        action: '/auth/logout',
        method: 'get',
        data: [
            {
                type: 'string',
                name: 'api_token',
                description: 'Enter your api token',
                param_type: 'query',
                required: true
            }
        ]
    },

    {
        title: 'Register',
        description: 'Create a new account',
        action: '/auth/register',
        method: 'post',
        data: [
        
             {
                type: 'username',
                name: 'username',
                description: 'Enter your username',
                param_type: 'form',
                required: true
            },
            {
                type: 'email',
                name: 'email',
                description: 'Enter your email',
                param_type: 'form',
                data_type: 'email',
                required: true
            },
            {
                type: 'password',
                name: 'password',
                description: 'Enter your password',
                param_type: 'form',
                required: true
            }
        ]
    }


];