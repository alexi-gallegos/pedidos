import Vue from 'vue';
import axios from 'axios';

var app = new Vue({
    el : '#menu',
    created : function(){
       this.getMenus();
    },
    data:{
        message : 'hello',
        nuevoMenu : false,
        productosDetalle : [],
        totales : [],
        nombreMenu : '',
        total : 0,
        categorias : [],
        showDetail: [],
        datos : [],
        currentCategory : '', //Categoria seleccionada para mostrar sus productos 
        products : [],
        productosPush:{'id':'','nombre_producto':'','valor_unidad':'','cantidad':'','valor_total':''},

    },
    methods : {
        getMenus(){
            var url = 'menus';
            axios.get(url)
            .then(response => {
                this.datos = response.data;
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            });
        },
        showDetalle(producto){
            this.showDetail = [];
            this.showDetail = producto;
            $('#show').modal('show');
        },
        newMenu(){
            this.getCategorias();
            this.nuevoMenu = true;

        },
        cancelarNuevoMenu(){
            this.nuevoMenu = false;
            this.productosDetalle = [];
            this.totales = [];
            this.total = 0;
            this.categorias = [];
            this.currentCategory = '';
            this.products = [];
            this.productosPush = {'id':'','nombre_producto':'','valor_unidad':'','cantidad':'','valor_total':''};
        },  
        getCategorias(){
            var url = 'categories';
            axios.get(url)
            .then(response => {
                this.categorias = response.data;
            });
        },
        loadProducts(){
            url = 'products_categories';
            axios.get(url,{
                params:{
                    id: this.currentCategory
                }
            })
            .then(response =>{
                this.products = response.data;            
            });
        },
        valorProducto(producto,id){
            var cantidad = $('#'+id).val(); //obtener la cantidad de productos 
            if(cantidad == 0 || cantidad == ''){ // verificar que la cantidad de productos sea mayor a 0
                $('#'+id).val('');
                $.notify('La cantidad debe ser un número mayor a 0','warn');
            }else{
                
            var index = this.productosDetalle.findIndex(function(x) { return x.id == producto.id; }); // verificar si el producto ya está en el array de productosDetalle
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
           var index = this.productosDetalle.findIndex(function(x) { return x.id == producto.id; }); //calcular en que posicion (index del array) está el elemento con el ID dado 
            this.productosDetalle.splice(index,1); //remover el elemento con el ID calculado, el cual es index

            //borrar valor del array de valores totales 
            var indexValores = this.totales.findIndex(function(x) { return x.id == producto.id; }); //calcular en que posicion (index del array) está el elemento con el ID dado
            this.totales.splice(indexValores,1);

            this.total = this.total - producto.valor_total; //restamos el valor del producto eliminado al total del valor

            if(this.total == 0 ){
                this.total = 0;
            }
           
        },
        crearMenu(){
            // console.log(this.total);
            // console.log(this.productosDetalle);
            // console.log(this.nombreMenu);

            if(this.nombreMenu == ''){
                $.notify('El Menú debe tener un nombre.');
            }

            axios.post('menus',{
                total : this.total,
                productos : this.productosDetalle,
                nombre_menu : this.nombreMenu
            }).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error);
            });


        }
    },
    watch:{
        currentCategory: function(){
            this.loadProducts();
        },
    },
});