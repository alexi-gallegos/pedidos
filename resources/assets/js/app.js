var vm = new Vue({
    el :'#app',
    created : function(){
        var pen = $('#pendiente').val();
        var nuevo = $('#new').val();
        var worker = $('#worker').val();
        var finished = $('#finalizados').val();
        var push = $('#push').val();
        var user = $('#usuarios').val();
        this.getData();
        this.loadTables();
        this.getCategorias();
        if(worker == 1){
        this.getCargos();
        }
        if(pen == 1){
        this.getPendientes();
        }
        if(user == 1){
            this.getUsuarios();
        }

        if(finished == 1){
        this.getFinalizados();
        }
        if(push == 1){
        this.dataPush();
        }
    },
    data :{

        datos : [],
        cargos: [],
        categories: [],
        tables:[],
        users : [],
        products: [],
        productosDetalle:[],
        productosPush:{'id':'','nombre_producto':'','valor_unidad':'','cantidad':'','valor_total':''},
        currentProduct:'',
        detalle : [],
        pendientes : [],
        idNewPass : 0,
        finalizados: [],
        dataPusher: [],
        type0 : null,  //tipo de reporte en CrearPDF
        productsPDF : [], //Los productos para crear el PDF
        totalMoney : 0, //Dinero total en PDF
        total: 0,
        mesa : '',
        dateFrom:'',
        dateTo:'',
        dateSearch: [],
        showDetail: [],
        
        totales:[],
        newPosition : {'cargo' :'', 'descripcion' : ''},
        fillPosition : {'id': null, 'cargo' :'', 'descripcion' : ''},
        newWorker :{'rut':'', 'nombres':'','cargo': '', 'apellido_p':'', 'apellido_m':'', 'direccion':'',
                    'telefono':'', 'nombre_emergencia':'', 'telefono_emergencia':''},
        fillWorker :{'rut':'', 'nombres':'','cargo': '', 'apellido_p':'', 'apellido_m':'', 'direccion':'',
                    'telefono':'', 'nombre_emergencia':'', 'telefono_emergencia':''},
        newCategory : {'descripcion':''},
        fillCategory:{'descripcion':''},
        newProduct:{'nombre_producto':'', 'valor_unidad': null, 'categoria_id': ''},
        fillProduct:{'nombre_producto':'', 'valor_unidad': null, 'categoria_id': '', 'disponibilidad':''},
        newTable : {'numero_mesa':''},
        newUser : {'nombre' : '', 'email':'', 'password':'','admin':0, 'trabajador':''},
        fillUser : {'id':'', 'nombre' : '', 'email':'', 'password':'','admin':0, 'trabajador':''},
        fillTable:{'id':'','numero_mesa':'', 'disponible':''},
        errors : [],
        periodo : '',
        url:'',
        productos_object : [],
        productos : [],
        password : '', //password en newpass.blade.php
        desdeDate:'',
        productosPDF : [],
        cantidadesPDF:[],
        preciosPDF:[],
        totalResults : 0,
        hastaDate:'',
        eliminar : {'delete' : 1, 'id' : ''}, 
        pagination : {
            'total' : 0,
            'current_page' : 0,
            'per_page' : 0,
            'last_page'  : 0,
            'from'   : 0,
            'to'   : 0
        },
        offset : 5
    },
    methods:{
        datesSearch(){
            let fina = $('#finalizados').val();
            var ac = 0;
            chech = $('#check').val();
            if(fina == 1){
                ac = 0;
            }
            if(this.dateFrom == '' || this.dateTo == ''){
                $.notify('Ingrese la fecha Desde y la fecha Hasta, por favor.','warn');
            }else{
                if(fina != 1){
                    ac = 4;
                }
                this.desdeDate = this.dateFrom+' 00:00:00';
                this.hastaDate = this.dateTo+' 23:59:59';
                let final = $('#finalizados').val();
                let url = 'pending_orders';
            if(check == undefined){
                axios.get(url,{
                    params:{
                        dateFrom : this.desdeDate,
                        dateTo : this.hastaDate,
                        action : ac
                    }
                }).then(response => {
                    console.log(response);
                    if(response.data == ''){
                        $.notify('No hay registros entre estas fechas','error');
                    }else{
                    this.dateSearch = response.data;
                    this.totalResults = this.dateSearch.length;
                    $('#date').modal('hide');
                    }
                }).catch(error => {
                   
                    
                });
        }else if(fina == 1){  // busqueda por trabajador individual finalizados
            axios.get(url,{
                params:{
                    dateFrom : this.desdeDate,
                    dateTo : this.hastaDate,
                    action : 8,
                    id_worker: check
                }
            }).then(response => {
                if(response.data == ''){
                    $.notify('No hay registros entre estas fechas','error');
                }else{
                this.dateSearch = response.data;
                this.totalResults = this.dateSearch.length;
                $('#date').modal('hide');
                }
            }).catch(error => {
               
                
            });
        }else{
            axios.get(url,{   // busqueda fechas pendientes por trabajador 
                params:{
                    dateFrom : this.desdeDate,
                    dateTo : this.hastaDate,
                    action : 9,
                    id_worker: check
                }
            }).then(response => {
                if(response.data == ''){
                    $.notify('No hay registros entre estas fechas','error');
                }else{
                this.dateSearch = response.data;
                this.totalResults = this.dateSearch.length;
                $('#date').modal('hide');
                }
            }).catch(error => {
               
                
            });
        }
    }

       
    },
        cleanSearch(){
            this.dateSearch = [];
            this.desdeDate = '';
            this.hastaDate = '';
            this.dateFrom = '';
            this.dateTo = '';

        },
        showPass(){
            var input = $('.toggle-pass');
            if (input.attr("type") == "password") {
              input.attr("type", "text");
            } else {
              input.attr("type", "password");
            }
        },
        valorProducto(producto,id){
            var cantidad = $('#'+id).val(); //obtener la cantidad de productos 
            if(cantidad == 0 || cantidad == ''){ // verificar que la cantidad de productos sea mayor a 0
                $('#'+id).val('');
                $.notify('La cantidad debe ser un número mayor a 0','warn');
            }else{
                
            index = this.productosDetalle.findIndex(function(x) { return x.id == producto.id; }); // verificar si el producto ya está en el array de productosDetalle
            if(index == -1){

            var valor_total_producto = producto.valor_unidad*cantidad; //calcular valor total del producto, producto * cantidad
            this.productosPush.id = producto.id;  //asignar valor del objeto que viene del boton "agregar" a un objeto que tiene adicionalmente valor_total de pedido
            this.productosPush.nombre_producto = producto.nombre_producto;  //asignar valor del objeto que viene del boton "agregar" a un objeto que tiene adicionalmente valor_total de pedido
            this.productosPush.valor_unidad = producto.valor_unidad;  //asignar valor del objeto que viene del boton "agregar" a un objeto que tiene adicionalmente valor_total de pedido
            this.productosPush.cantidad = cantidad;  //asignar valor del objeto que viene del boton "agregar" a un objeto que tiene adicionalmente valor_total de pedido
            this.productosPush.valor_total = valor_total_producto;  //asignar valor del objeto que viene del boton "agregar" a un objeto que tiene adicionalmente valor_total de pedido
            this.productosDetalle.push(this.productosPush); // pushear el objeto creado a un array de objetos que va a ser la orden final

            this.totales.push({'id':id,'total':parseInt(valor_total_producto)});

            
           


            //limpiar campos 
            this.productosPush={'id':'','nombre_producto':'','valor_unidad':'','cantidad':'','valor_total':''};
            
            this.total = this.productosDetalle.reduce(function(acc,val,i,productosDetalle){ //con la funcion reduce sumamos todos y cada unos de los objetos dentro del array de objetos productosDetalle, devolviendolo en la variable this.total
                return acc+productosDetalle[i].valor_total
              },0);

            //console.log(producto.nombre_producto +' $'+ producto.valor_unidad +' '+ cantidad +' valor total es : $'+ valor_total_producto);
            $('#'+id).val(''); //limpiar campos
            }else{
                $.notify(producto.nombre_producto+' ya se encuentra en el pedido','warn');
                $('#'+id).val(''); //limpiar campos
            }

            }
        },
        deleteProductoDetalle(producto){
            index = this.productosDetalle.findIndex(function(x) { return x.id == producto.id; }); //calcular en que posicion (index del array) está el elemento con el ID dado 
            this.productosDetalle.splice(index,1); //remover el elemento con el ID calculado, el cual es index

            //borrar valor del array de valores totales 
            indexValores = this.totales.findIndex(function(x) { return x.id == producto.id; }); //calcular en que posicion (index del array) está el elemento con el ID dado
            this.totales.splice(indexValores,1);

            this.total = this.total - producto.valor_total; //restamos el valor del producto eliminado al total del valor

            if(this.total == 0 ){
                this.total = 0;
            }
           
        },
        getData(){
            var urlData = $('#url').val();
            axios.get(urlData)
            .then(response =>{
                this.datos = response.data  
            }).catch(error => {
               
            });
        },
        getCargos(){
            var url = 'position';
            axios.get(url)
            .then(response => {
                this.cargos = response.data;
            });
        },
        getUsuarios(){
            var url = 'workers';
            axios.get(url)
            .then(response => {
                this.users = response.data;
                
            });
        },
        getCategorias(){
            var url = 'categories';
            axios.get(url)
            .then(response => {
                this.categories = response.data;
            });
        },
        deleteData(data,url1){
            $.confirm({
                title: 'Confirme',
                content: '¿Seguro que quiere eliminar este registro <strong>'+ data[Object.keys(data)[1]] +'</strong> ?',
                buttons: {
                        eliminar:{ 
                        btnClass: 'btn-danger',
                        action: () => {
                        url = url1 + data.id;
                        vm.eliminar.id = data.id;
                        axios.put(url,{
                            delete: vm.eliminar
                        })
                            .then(response => {
                            vm.getData();
                            $.notify('Registro eliminado.','success');
                                });
                            }
                        },
                            cancelar:{
                            btnClass: 'btn-dark',
                            action: () => {
                                return true;
                        }
                
                },
            }
                
            });
        },
        createPosition(){
            var url = $('#url').val() ;
            axios.post(url,{
                position : this.newPosition
            }).then(response => {
                vm.getData();
                vm.newPosition = {'nombre_garantia' :'', 'descripcion' : ''};
                vm.errors = [];
                $('#create').modal('hide');
                $.notify('Nuevo Cargo creado con éxito','success');
            }).catch(error => {
                vm.errors = error.response.data.errors
                
                
            })
        },
        clearErrors(){
            vm.errors = [];
            $('#correo').val(" ");
            $('#contra').val(" ");
        },
        editPosition(position){
            vm.errors = [];
            vm.fillPosition.id = position.id;
            vm.fillPosition.cargo = position.cargo;
            vm.fillPosition.descripcion = position.descripcion;
            
            $('#edit').modal('show');

        },
        updatePosition(id){

            var url = 'position/'+id;
            axios.put(url, {
                position : vm.fillPosition
            })
            .then(response => {
                vm.getData();
                fillPosition = {'cargo' :'' , 'descripcion' : ''};
                vm.errors = [];
                $.notify('Registro actualizado exitosamente.','success');
                $('#edit').modal('hide');
            })
            .catch(error => {
                vm.errors = error.response.data.errors
            });

        },
        createWorker(){
            
            var url = $('#url').val() ;
            axios.post(url,{
                worker : this.newWorker
            }).then(response => {
                vm.getData();
                vm.newWorker = {'rut':'', 'nombres':'','cargo': '', 'apellido_p':'', 'apellido_m':'' , 'direccion':'',
                'telefono':'', 'nombre_emergencia':'', 'telefono_emergencia':''};
                vm.errors = [];
                $('#create').modal('hide');
                $.notify('Nuevo Trabajador creado con éxito','success');
            }).catch(error => {
                vm.errors = error.response.data.errors
                
            })
        },
        editWorker(worker){
            vm.errors = [];
            vm.fillWorker.id = worker.id;
            vm.fillWorker.rut = worker.rut;
            vm.fillWorker.nombres = worker.nombres;
            vm.fillWorker.apellido_p = worker.apellido_paterno;
            vm.fillWorker.apellido_m = worker.apellido_materno;
            vm.fillWorker.cargo = worker.cargo_id;
            vm.fillWorker.telefono = worker.telefono;
            vm.fillWorker.direccion = worker.direccion;
            vm.fillWorker.nombre_emergencia = worker.nombre_contacto_emergencia;
            vm.fillWorker.telefono_emergencia = worker.numero_contacto_emergencia;
            
            $('#edit').modal('show');

        },
        updateWorker(id){

            var url = 'workers/'+id;
            axios.put(url, {
                worker : vm.fillWorker
            })
            .then(response => {
                vm.getData();
                vm.fillWorker = {'rut':'', 'nombres':'','cargo': '', 'apellido_p':'', 'apellido_m':'' , 'direccion':'',
                'telefono':'', 'nombre_emergencia':'', 'telefono_emergencia':''};
                vm.errors = [];
                $.notify('Registro actualizado exitosamente.','success');
                $('#edit').modal('hide');
            })
            .catch(error => {
                vm.errors = error.response.data.errors
            });

        },
        createCategory(){
            var url = $('#url').val() ;
            axios.post(url,{
                category : this.newCategory
            }).then(response => {
                vm.getData();
                vm.newCategory = {'descripcion' :''};
                vm.errors = [];
                $('#create').modal('hide');
                $.notify('Nueva Categoria creada con éxito','success');
            }).catch(error => {
                vm.errors = error.response.data.errors
                
            })
        },
        editCategory(category){
            vm.errors = [];
            vm.fillCategory.id = category.id;
            vm.fillCategory.descripcion = category.descripcion;
            
            $('#edit').modal('show');

        },
        updateCategory(id){

            var url = 'categories/'+id;
            axios.put(url, {
                category : vm.fillCategory
            })
            .then(response => {
                vm.getData();
                fillCategory = {'descripcion' :''};
                vm.errors = [];
                $.notify('Registro actualizado exitosamente.','success');
                $('#edit').modal('hide');
            })
            .catch(error => {
                vm.errors = error.response.data.errors
            });

        },
        createProduct(){
            var url = $('#url').val() ;
            axios.post(url,{
                product : this.newProduct
            }).then(response => {
                vm.getData();
                vm.newProduct = {'nombre_producto':'', 'valor_unidad': null, 'categoria_id': ''};
                vm.errors = [];
                $('#create').modal('hide');
                $.notify('Nuevo Producto creado con éxito','success');
            }).catch(error => {
                vm.errors = error.response.data.errors
                
                
                
            })
        },
        editProduct(product){
            vm.errors = [];
            vm.fillProduct.id = product.id;
            vm.fillProduct.nombre_producto = product.nombre_producto;
            vm.fillProduct.valor_unidad = product.valor_unidad;
            vm.fillProduct.categoria_id = product.categoria_id;
            vm.fillProduct.disponibilidad = product.disponible;
            
            $('#edit').modal('show');

        },
        updateProduct(id){

            var url = 'products/'+id;
            axios.put(url, {
                product : vm.fillProduct
            })
            .then(response => {
                vm.getData();
                fillProduct = {'nombre_producto':'', 'valor_unidad': null, 'categoria_id': '', 'disponibilidad':''};
                vm.errors = [];
                $.notify('Registro actualizado exitosamente.','success');
                $('#edit').modal('hide');
            })
            .catch(error => {
                vm.errors = error.response.data.errors
            });

        },
        createTable(){
            var url = $('#url').val() ;
            axios.post(url,{
                table : this.newTable
            }).then(response => {
                if(response.data == 1){
                    $.notify('Esta mesa ya está registrada','warn');
                }else{
                vm.getData();
                vm.newTable = {'numero_mesa' :''};
                vm.errors = [];
                $('#create').modal('hide');
                $.notify('Nueva Mesa creada con éxito','success');
                }
            }).catch(error => {
                vm.errors = error.response.data.errors
                
            });
        },
        editTable(table){
            vm.errors = [];
            vm.fillTable.id = table.id;
            vm.fillTable.numero_mesa = table.numero_mesa;
            vm.fillTable.disponible = table.disponible;
            
            $('#edit').modal('show');

        },
        updateTable(id){

            var url = 'tables/'+id;
            axios.put(url, {
                table : vm.fillTable
            })
            .then(response => {
                vm.getData();
                fillTable = {'id':'', 'numero_mesa': '', 'disponible':''};
                vm.errors = [];
                $.notify('Registro actualizado exitosamente.','success');
                $('#edit').modal('hide');
            })
            .catch(error => {
                vm.errors = error.response.data.errors
            });

        },
        loadProducts(){
            url = 'products_categories';
            axios.get(url,{
                params:{
                    id: this.currentProduct
                }
            })
            .then(response =>{
                this.products = response.data;
                
            });
        },
        loadTables(){
            url = 'tables';
            axios.get(url,{
                params:{
                    id: 1
                }
            })
            .then(response =>{
                this.tables = response.data;
                
            });
        },
        sendPedido(){
            if(this.mesa == ''){

                $.notify('Seleccione una mesa, por favor.','info');

            }else{
                url = 'pedidos';
                let id_worker = $('#id_worker').val();
                axios.post(url,{
                    pedido : this.productosDetalle,
                    total : this.total,
                    mesa : this.mesa,
                    id_trabajador : id_worker
                }).then(response => {
                    $.notify('Pedido realizado con éxito','success'); 
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }).catch(error => {
                    $.notify('Hubo un error al realizar su pedido','error');
                    console.log(error);
                   
                });
            }   
            
        },
        getPendientes(page,id_worker){
            url = "pending_orders?page="+page;
            check = $('#check').val();

         
            
            if(check == undefined){
            axios.get(url,{
                params :{
                    action : 5
                }
            })
            .then(response => {
               
                this.pendientes = response.data.pedidos.data;
                this.pagination = response.data.pagination;
                
            }).catch(error =>{

                
            });
        }else{
            axios.get(url,{
                params :{
                    action : 6,
                    id_worker : check 
                }
            })
            .then(response => {
               
                this.pendientes = response.data.pedidos.data;
                this.pagination = response.data.pagination;
                
            }).catch(error =>{
          
                
            });
        }
        },
        getFinalizados(page){
            url = "pending_orders?page="+page;
            check = $('#check').val();
       
            if(check == undefined){
            axios.get(url,{
                params:{
                    action : 3
                }
            })
            .then(response => {
                this.finalizados = response.data.pedidos.data;
                this.pagination = response.data.pagination;
                
            }).catch(error =>{
                
            });
            }else{
                axios.get(url,{
                    params:{
                        action : 7,
                        id_worker: check
                    }
                })
                .then(response => {
                    this.finalizados = response.data.pedidos.data;
                    this.pagination = response.data.pagination;
                    
                }).catch(error =>{
                    
                });
            }
        },
        entregarPedido(id){
            url = "pending_orders/"+ id;
            axios.put(url,{
                id : id,
                action : 2
            })
            .then(response => {
                this.getPendientes();
                $.notify('Pedido ha sido entregado','success');
            }).catch(error => {
               
            });
        },
        finalizarPedido(id,id_mesa){
            url = "pending_orders/"+ id;
            axios.put(url,{
                id : id,
                action : 3,
                mesa : id_mesa
            })
            .then(response => {
                this.getPendientes();
                $.notify('Pedido ha finalizado','success');
            }).catch(error => {
               
            });
        },
        showDetalle(producto){
            this.showDetail = [];
            this.showDetail = producto;
            $('#show').modal('show');
        },
        
        changePage(page){
            var fin = $('#finalizados').val();
            vm.pagination.current_page = page;
            if(fin == 1){
            vm.getFinalizados(page);
            }else{
            vm.getPendientes(page);
            }
            
        },
        moment: function () {
            return moment().locale('es');
          },
        dataPush(){
             Pusher.logToConsole = true;

            var pusher = new Pusher('208ad815727d562929b5', {
            cluster: 'us2',
            encrypted: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                this.dataPusher = data;
              
                $.alert({
                    title: '¡ATENCIÓN!',
                    content: '¡Número de Pedido <b>'+this.dataPusher[1] +'</b>!<br/>'+
                                this.dataPusher[0].map(function(data) {
                                    return '<b>'+ data.cantidad +' '+data.nombre_producto+'</b> ';
                                })
                });
            });
        },
        createUser(){
            var url = $('#url').val() ;
            axios.post(url,{
                user : this.newUser
            }).then(response => {
               console.log(response);
                if(response.data === 0){
                    $.notify('Este trabajador ya se encuentra ligado a un usuario.','error');
                }else{
                vm.getData();
                vm.newUser = {'nombre' :'', 'email':'', 'password':'','admin': 0 , 'trabajador':''};
                vm.errors = [];
                $('#create').modal('hide');
                $.notify('Nuevo Usuario creado con éxito','success');
                }
                
            }).catch(error => {
                vm.errors = error.response.data.errors
                console.log(error);
                
            })
        },
        editUser(user){
            vm.errors = [];
            vm.fillUser.id = user.id;
            vm.fillUser.nombre = user.name;
            vm.fillUser.email = user.email;
            vm.fillUser.password = user.password;
            vm.fillUser.trabajador = user.id_trabajador;
            vm.fillUser.admin = user.isAdmin;
            
            $('#edit').modal('show');

        },

        updateUser(id){

            var url = 'users/'+id;
            axios.put(url, {
                user : vm.fillUser
            })
            .then(response => {
                console.log(response);

                vm.getData();
                fillUser = {'id':'','nombre' :'', 'email':'', 'password':'','admin': 0 , 'trabajador':''};
                vm.errors = [];
                $.notify('Registro actualizado exitosamente.','success');
                $('#edit').modal('hide');
            })
            .catch(error => {
                vm.errors = error.response.data.errors;
            });

        },
        newPassFill(id){
            this.idNewPass = id;
        },
        newPass(id){

            if(this.password.length < 5){
                $.notify('La contraseña debe tener al menos 6 caracteres','warn');
            }else{
            let url = 'newpass/'+id;
            axios.put(url,{
                password : this.password
            }).then(response => {
                if(response.data === 0){
                    $.notify('La contraseña no puede ser la misma que la anterior','error');
                    this.idNewPass = 0;
                    this.password = '';
                    $('#newpass').modal('hide');
                }else{
                $.notify('Contraseña actualizada correctamente.','success');
                this.idNewPass = 0;
                this.password = '';
                $('#newpass').modal('hide');
                }
                
            }).catch(error => {
           
                console.log(error);
            });
        }
    },
    createChart(type){
            type = typeof type !== 'undefined' ? type : 0;

            if(type == 1){ // reporte semanal
            
             var  start0 =  moment().startOf('isoWeek');
             var  start1 = moment(start0).format('YYYY/MM/DD');
             var  end0    = moment().endOf('isoWeek');
             var  end1 = moment(end0).format('YYYY/MM/DD');

             var start =  start1+' 00:00:00';
             var end =  end1+' 23:59:59';

             var start_pdf = moment(start0).format('DD/MM/YYYY');
             var end_pdf = moment(end0).format('DD/MM/YYYY');
             vm.periodo = 'desde '+start_pdf+' hasta '+end_pdf;
             console.log(vm.periodo);
             //console.log(type);

            }else if(type == 0){  //reporte diario

            var today = moment().utcOffset(-4);
            var today_formatted = moment(today).format('YYYY/MM/DD');
            var start = today_formatted+ ' 00:00:00';
            var end = today_formatted+ ' 23:59:59';
            //console.log(`This is ${start} and ${end}`);
             vm.periodo =  moment(today).locale('es').format('LL');
            
            
            
            }else if(type == 2){ //reporte mensual
                var  start0 =  moment().startOf('Month');
                var  start1 = moment(start0).format('YYYY/MM/DD');
                var  end0    = moment().endOf('Month');
                var  end1 = moment(end0).format('YYYY/MM/DD');

                var start =  start1+' 00:00:00';
                var end =  end1+' 23:59:59';
                vm.periodo = moment().locale('es').format('MMMM YYYY');
                console.log(vm.periodo);
               
            }else if(type == 3){ //reporte anual
                var  start0 =  moment().startOf('Year');
                var  start1 = moment(start0).format('YYYY/MM/DD');
                var  end0    = moment().endOf('Year');
                var  end1 = moment(end0).format('YYYY/MM/DD');

                var start =  start1+' 00:00:00';
                var end =  end1+' 23:59:59';

                var y = moment().format('YYYY');
                vm.periodo = 'Año '+y;
                console.log(vm.periodo);
               
            }else if(type == 4){

                var start1 = $('#date1').val();
                var end1 = $('#date2').val();

                if(start1 == '' && end1 == ''){
                    $.notify('Por favor, ingrese las 2 fechas.','warn');
                    return false;
                }else{
                    var start =  start1+' 00:00:00';
                    var end =  end1+' 23:59:59';
                    var  start1 = moment(start0).format('DD/MM/YYYY');
                    var  end1 = moment(end0).format('DD/MM/YYYY');

                    vm.periodo = 'desde '+start1+' hasta '+end1;


                    
                }

                
                
                

            }
            
         

            let url = 'chart_today';
            axios.get(url,{
                params:{
                    desde : start,
                    hasta : end
                }
            }).then(response => {
                

                


                    if(response.data == 0 ) {
                        $.notify('Aún no hay registros en este periodo de tiempo.','warn');
                    }else{
                            var prs = [];
                            this.type0 = type;
                            this.totalMoney =  response.data[1];
                      
                            var productos_chart = "";
                            var precios_chart = "";
                            var precios_totales_chart = "";
                            var arr = "";

                            var productos_chart = Object.keys(response.data[0]);
                            var precios_chart = Object.values(response.data[0]);
                            var precios_totales_chart = response.data[2];

                            this.productosPDF = productos_chart;
                            this.cantidadesPDF = precios_chart;
                            this.preciosPDF = precios_totales_chart;  //productos
                            



                            var arr = Object.keys(precios_totales_chart).map(function (key) { return precios_totales_chart[key]; }); //precios totales de cada caetogoria, ejemplo completo en el dia $5000

                            var arr2 = Object.keys(precios_totales_chart).map(function (key) { return precios_totales_chart[key].toLocaleString() ; }); //precios totales de cada caetogoria, ejemplo completo en el dia $5000
                            
                            var x = productos_chart.length;


                            var prices_str = arr2.map(String);
                            var cantidad_str = precios_chart.map(String);

                            var procs = [];
                            var temporary = [];
                            
                            for (let index = 0; index < x ; index++) {

                                 temporary.push([productos_chart[index],cantidad_str[index],'$'+prices_str[index]]);

                                procs = prs.concat(temporary);
                                
                            }

                            this.productsPDF = procs;
                            

                    

                        
                                if(type == 0){
                                $("#myChartDia").show();

                                $("#myChartSemana").hide();
                                $("#myChartMes").hide();
                                $("#myChartYear").hide();

                                $("#myChartDia").remove(); //remover canvas
                                $('#canv'). 
                                append('<canvas id="myChartDia" height="38%" width="100%"> </canvas>') ; // agregar nuevo canvas
                                
                                var ctx = $("#myChartDia");
                                
                                }else if(type == 1){

                                 $("#myChartSemana").show();

                                 
                                 $("#myChartDia").hide();
                                 $("#myChartMes").hide();
                                 $("#myChartYear").hide();

                                 $("#myChartSemana").remove(); //remover canvas
                                 $('#canv'). 
                                 append('<canvas id="myChartSemana" height="38%" width="100%"> </canvas>') ; // agregar nuevo canvas

                                 var ctx = $("#myChartSemana");

                                }else if(type == 2){
                                $("#myChartMes").show();

                                $("#myChartDia").hide();
                                $("#myChartSemana").hide();
                                $("#myChartYear").hide();

                                $("#myChartMes").remove(); //remover canvas
                                $('#canv'). 
                                append('<canvas id="myChartMes" height="38%" width="100%"> </canvas>') ; // agregar nuevo canvas

                                var ctx = $("#myChartMes");


                                }else if(type == 3){
                                $("#myChartYear").show();

                                $("#myChartDia").hide();
                                 $("#myChartMes").hide();
                                 $("#myChartSemana").hide();

                                 $("#myChartYear").remove(); //remover canvas
                                 $('#canv'). 
                                 append('<canvas id="myChartYear" height="38%" width="100%"> </canvas>') ; // agregar nuevo canvas

                                 var ctx = $("#myChartYear");


                                }else if(type == 4){
                                

                                $("#myChartCustom").show();

                                $('#date').modal('hide');
                                $("#myChartDia").hide();
                                 $("#myChartMes").hide();
                                 $("#myChartSemana").hide();
                                 $("#myChartYear").hide();

                               
                                    $("#myChartCustom").remove(); //remover canvas
                                    $('#canv'). 
                                    append('<canvas id="myChartCustom" height="38%" width="100%"> </canvas>') ; // agregar nuevo canvas
                                    var ctx = $("#myChartCustom");
                                //}

                                

                                }

                                Chart.defaults.global.defaultFontFamily = "Lato";
                                Chart.defaults.global.defaultFontSize = 18;
                                Chart.plugins.register({
                                    beforeDraw: function(chartInstance) {
                                      var ctx = chartInstance.chart.ctx;
                                      ctx.fillStyle = "white";
                                      ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
                                    }
                                  });

                                var cantidadData = {
                                label: 'Cantidad Vendida',
                                data: precios_chart,
                                backgroundColor: 'rgba(0, 99, 132, 0.6)',
                                borderWidth: 0,
                                yAxisID: "y-axis-density"
                                };

                                var dineroData = {
                                label: 'Dinero por producto ($)',
                                data: arr,
                                backgroundColor: 'rgba(99, 132, 0, 0.6)',
                                borderWidth: 0,
                                yAxisID: "y-axis-gravity"
                                };

                                var planetData = {
                                labels: productos_chart,
                                datasets: [cantidadData, dineroData]
                                };

                                var chartOptions = {
                                scales: {
                                    xAxes: [{
                                    barPercentage: 1,
                                    categoryPercentage: 0.6,
                                    ticks: {
                                        stepSize: 1,
                                        min: 0,
                                        autoSkip: false
                                    }
                                    },
                                    ],
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            userCallback: function(label, index, labels) {
                                                // when the floored value is the same as the value we have a whole number
                                                if (Math.floor(label) === label) {
                                                    return label;
                                                }
                           
                                            },
                                        },
                                        
                                    id: "y-axis-density"
                                    }, {
                                    id: "y-axis-gravity"
                                    },
                                ]
                                },
                                title: {
                                    display: true,
                                    text: 'Total dinero en productos vendidos: $'+response.data[1].toLocaleString()  
                                  }
                                };
                                
                                var barChart = new Chart(ctx, {
                                type: 'bar',
                                data: planetData,
                                options: chartOptions
                                });

                    } //else
                

            }).catch(error => {
                
            });



    },

    createPDF(){
        var doc = new jsPDF();
        var cantidades = vm.cantidadesPDF.map(String);

        var today = moment().utcOffset(-4);

        today = moment(today).locale('es').format('llll');
        doc.setFontSize(7)
        doc.text(2,4, today);
        

        var space = 10;

        doc.setFontSize(12)
        doc.text(14,12, 'Reporte Productos ');
        doc.text(53,12, vm.periodo);
       

        if(this.type0 == 0){
            var canvas = document.getElementById('myChartDia');
        }else if(this.type0 == 1){
        var canvas = document.getElementById('myChartSemana');
        }else if(this.type0 == 2){
            var canvas = document.getElementById('myChartMes');
        }else if(this.type0 == 3){
            var canvas = document.getElementById('myChartYear');
        }else if(this.type0 == 4){
            var canvas = document.getElementById('myChartCustom');
        }
        var dataURL = canvas.toDataURL('image/jpeg');
    
        var columns = ["Producto", "Cantidad", "Dinero Total($)"];                    

        doc.autoTable(columns, this.productsPDF);

    

        doc.setFontSize(14)
        doc.setFont('courier');
        doc.setFontType('bolditalic');

        doc.text(130,10, 'Dinero Total : $'+this.totalMoney.toLocaleString());


        doc.addPage();
        doc.addImage(dataURL, 'JPEG', 5 , 10, 200, 120);

        doc.save('Reporte.pdf');


    },
    cancelPedido(id){

        $.confirm({
            title: '¡ATENCIÓN!',
            content: '¿Seguro desea cancelar este pedido?',
            buttons: {
                SI:{ 
                btnClass : 'btn-success',
                action : function () {
                   var url = 'cancel/'+id;
                    axios.put(url)
                    .then(response => {
                        vm.getPendientes();
                        $.notify('Pedido cancelado','success');
                        
                    }).catch(error => {
                        $.notify('Hubo un error al cancelar el pedido.','error');
                    });
                }
                },
                NO:{ 
                btnClass : 'btn-danger',
                action : function () {
                    return true;
                }
             }
            }
        });
        
        

    }
        

    },
    watch:{
        currentProduct: function(){
            this.loadProducts();
        },
    },
    computed:{
        isActive(){
            return vm.pagination.current_page;
        },
        pagesNumber(){
            if(!this.pagination.to){
                return [];
            }

            var from = vm.pagination.current_page - vm.offset; 
            if(from < 1){
                from = 1;
            }

            var to = from + (vm.offset*2); 

            if(to >= vm.pagination.last_page){
                to = vm.pagination.last_page;
            }

            var pagesArray = [];

            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    filters: {
        moment: function (date) {
          return moment(date).locale('es').format('llll');
        },
        moments2(date){
            return moment(date).locale('es').format('LL');
        }
      }

});
