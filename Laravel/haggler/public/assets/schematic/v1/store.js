var page = [

   
    
     {
        title: 'List Deals',
        description: 'List deals',
        action: '/deal/list',
        method: 'get',
        data: [
        
             {
                type: 'text',
                name: 'vendorId',
                description: 'Vendor id to view deals from vendor store',
                param_type: 'query'
            },
            {
                type: 'text',
                name: 'categoryId',
                description: 'Category id to filter deals',
                param_type: 'query'
            },
            {
                type: 'text',
                name: 'orderBy',
                description: 'Order by',
                param_type: 'query'
            },
             {
                type: 'options',
                name: 'order',
                description: 'Order asc,desc',
                param_type: 'query',
                options: ['asc','desc'],
            },
            {
                type: 'text',
                name: 'limit',
                description: 'Limit per page',
                value: 15
            }

            
        ]
    }



];