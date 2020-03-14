var page = [

   
    {
        title: 'List Addresses',
        description: 'List User saved addresses',
        action: '/user/address',
        method: 'get',
        data: [
        
             {
                type: 'text',
                name: 'api_token',
                description: 'Your api token, login to get it.',
                param_type: 'query',
                required:true
            }         

            
        ]
    },

     {
        title: 'Get Adress',
        description: 'Get User saved address',
        action: '/user/address',
        method: 'get',
        data: [
        
             {
                type: 'text',
                name: 'api_token',
                description: 'Your api token, login to get it.',
                param_type: 'query',
                required:true
            },      
            {
                type: 'options',
                name: 'type',
                description: 'Select address type.',
                param_type: 'query',
                options: ['billing','shipping'],
                required:true
            },       

            
        ]
    },

     {
        title: 'Save Adress',
        description: 'Save user address',
        action: '/user/address',
        method: 'post',
        data: [
        
             {
                type: 'text',
                name: 'api_token',
                description: 'Your api token, login to get it.',
                param_type: 'query',
                required:true
            }, 

             {
                type: 'text',
                name: 'name',
                description: 'Enter your name',
                param_type: 'form',
                required:true
            },    
             {
                type: 'text',
                name: 'address',
                description: 'Enter your address.',
                param_type: 'form',
                required:true
            },    
             {
                type: 'text',
                name: 'city',
                description: 'Enter your city.',
                param_type: 'form',
                required:true
            },    
             {
                type: 'text',
                name: 'state',
                description: 'enter state name.',
                param_type: 'form',
                required:true
            },    
             {
                type: 'text',
                name: 'country',
                description: 'Enter your conutry',
                param_type: 'form',
                required:true
            },     
             {
                type: 'text',
                name: 'zipcode',
                description: 'Enter zipcode',
                param_type: 'form',
                required:true
            },         
            {
                type: 'options',
                name: 'type',
                description: 'Select address type.',
                param_type: 'form',
                options: ['billing','shipping'],
                required:true
            }            
        ]
    }



];