var page = [
    
    {
        title: 'List Categories',
        description: 'List products categories',
        action: '/product/categories',
        method: 'get',
        data: [
        
             {
                type: 'text',
                name: 'categoryParentId',
                description: 'Category id to view childrens',
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
                value: 15,
                data_type: 'int'
            },
            {
                type: 'text',
                name: 'page',
                description: 'Page Number',
                param_type: 'query',
                data_type: 'int',
                value:1
            }
            
        ]
    },
   
    {
        title: 'List',
        description: 'List products',
        action: '/product/list',
        method: 'get',
        data: [
        
             {
                type: 'vendorId',
                name: 'vendorId',
                description: 'Vendor id to view products from vendor store',
                param_type: 'query'
            },
            {
                type: 'text',
                name: 'categories',
                description: 'List from specific categories',
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
                value: 15,
                data_type: 'int'
            },
             {
                type: 'text',
                name: 'page',
                description: 'Limit per page',
                value: 15,
                data_type: 'int'
            }

            
        ]
    },
     {
        title: 'View Product',
        description: 'View Product',
        action: '/product/view/{productId}',
        method: 'get',
        data: [
        
             {
                type: 'text',
                name: 'productId',
                description: 'product id',
                param_type: 'path',
                data_type: 'int',
                required: true,
            }
            
        ]
    }


];