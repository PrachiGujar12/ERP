<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NCSaleController;




Route::get('/customer-login', [App\Http\Controllers\FrontendController::class, 'getLogin']);
Route::post('/customer-login', [App\Http\Controllers\FrontendController::class, 'postLogin'])->name('customer.login');
Route::get('/customer-register', [App\Http\Controllers\FrontendController::class, 'getRegister']);
Route::post('/customer-register', [App\Http\Controllers\FrontendController::class, 'postRegister'])->name('customer.register');
Route::post('/customer-logout', [App\Http\Controllers\FrontendController::class, 'postLogout'])->name('customer.logout');

Route::get('/home', [App\Http\Controllers\FrontendController::class, 'getHomePage']);

Route::middleware(['auth:online-customer'])->group(function () {
  // Product Routes
  Route::get('/productList', [App\Http\Controllers\FrontendController::class, 'getProductList']);
  Route::get('/product/{sku}/{productId}', [App\Http\Controllers\FrontendController::class, 'getProductDetails']);
  Route::get('/products/{slug}', [App\Http\Controllers\FrontendController::class, 'getProducts']);
  Route::get('/get-metal-image/{productId}/{title}', [App\Http\Controllers\FrontendController::class, 'getMetalImage'])->name('get-metal-image');
  Route::get('/product-image', [App\Http\Controllers\FrontendController::class, 'fetchProductImage'])->name('fetchProductImage');
  Route::get('/get-variations/{shape}/{metal_type}', [App\Http\Controllers\FrontendController::class, 'getVariations']);

  // Customer Profile Routes
  Route::get('/customer-profile', [App\Http\Controllers\FrontendController::class, 'getCustomerProfile']);
  Route::post('/customer/add-address', [App\Http\Controllers\FrontendController::class, 'addAddress'])->name('customer.addAddress');
  Route::get('/edit-customer-profile/{online_customer_id}', [App\Http\Controllers\FrontendController::class, 'editOnlineCustomer'])->name('edit-customer-profile');
  Route::post('/update-customer-profile/{online_customer_id}', [App\Http\Controllers\FrontendController::class, 'updateCustomerProfile'])->name('customer.updateProfile');

  // Frontend Blog Routes
  Route::get('/blog', [App\Http\Controllers\FrontendController::class, 'blogs']);
  Route::get('/blog/{category}/{slug}', [App\Http\Controllers\FrontendController::class, 'blogSingle']);
  Route::get('/blog/{subcategory}/{category}/{slug}', [App\Http\Controllers\FrontendController::class, 'blogSinglenew']);
  Route::get('/blog/{tag}', [App\Http\Controllers\FrontendController::class, 'tagname']);

  Route::post('/online-orders', [App\Http\Controllers\FrontendController::class, 'postOnlineOrders'])->name('store.online.orders');
  Route::get('/cart/{online_order_id}', [App\Http\Controllers\FrontendController::class, 'getCart'])->name('add.to.cart');
  Route::delete('/cart/remove/{orderId}',[App\Http\Controllers\FrontendController::class, 'remove'])->name('cart.remove');
  Route::post('/checkout/{online_order_id}', [App\Http\Controllers\FrontendController::class, 'checkout'])->name('checkout');
  Route::get('/success', [App\Http\Controllers\FrontendController::class, 'getSuccess']);
});

Route::get('/', function () {return view('welcome');})->name('welcome');

	Route::get('/print-invoice/{saleid}', [App\Http\Controllers\SaleController::class, 'invoiceprint'])->name('print.invoice.details');
Route::get('/invoice/download-pdf/{id}', [App\Http\Controllers\SaleController::class, 'downloadPdf'])->name('invoice.download.pdf');


Route::middleware(['auth', 'verified'])->group(function () {
	
			  
	Route::get('/customers/search', [App\Http\Controllers\AdminController::class, 'searchcustomers']);

	Route::get('/customers/search/{id}', [App\Http\Controllers\AdminController::class, 'showcustomer']);

	Route::get('/fetch-item', [App\Http\Controllers\SaleController::class, 'fetchItem']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/dashboard', function () {return view('dashboard.index');})->name('dashboard');
   



    Route::middleware(CheckUserType::class . ':staff')->group(function () {
  
        Route::resource('/dashboard/staff', UserController::class);

    });

    Route::middleware(CheckUserType::class . ':customer')->group(function () {

		
			
    Route::post('/store-customer', [App\Http\Controllers\AdminController::class, 'storeAddCustomer'])->name('store.customer');
			
    Route::get('/customers-list', [App\Http\Controllers\AdminController::class, 'getCustomerList'])->name('customers.list');
	Route::get('/due-customers-list', [App\Http\Controllers\AdminController::class, 'getDueCustomerList'])->name('due.customers.list');
	Route::get('/due-customers-view/{customer_id}', [App\Http\Controllers\AdminController::class, 'getDueCustomerView'])->name('due.customers.view');
		
	Route::get('/due-detail-view/{customer_id}', [App\Http\Controllers\AdminController::class, 'getDueDetailView'])->name('due.detail.view');
		
    Route::get('/add-customer', [App\Http\Controllers\AdminController::class, 'getAddCustomer'])->name('customers.add');
    Route::post('/add-customer', [App\Http\Controllers\AdminController::class, 'postAddCustomer'])->name('add.customer');
    Route::get('/edit-customer/{customer_id}', [App\Http\Controllers\AdminController::class, 'editCustomer'])->name('edit.customer');
    Route::post('/update-customer/{customer_id}', [App\Http\Controllers\AdminController::class, 'updateCustomer'])->name('update.customer');
    Route::delete('/delete-customer/{customer_id}', [App\Http\Controllers\AdminController::class, 'deleteCustomer'])->name('delete.customer');
	Route::get('/view-customer/{customer_id}', [App\Http\Controllers\AdminController::class, 'viewCustomer'])->name('view.customer');
   	Route::get('/customer/view-sales-items/{sale_id}', [App\Http\Controllers\SaleController::class, 'viewcustomerSalesItems'])->name('customer.view.sales.items');
		
	Route::get('/customer/order-view/{order_no}/{itemid}', [App\Http\Controllers\RepairController::class, 'showcustomerOrderDetails'])->name('customer.order.details');
	
	Route::get('/customer/order-view-details/{order_no}', [App\Http\Controllers\RepairController::class, 'viewcustomerOrderDetails'])->name('customer.order.view');
		
		Route::get('/customer/repair-items/{repair_order_no}', [App\Http\Controllers\RepairController::class, 'showCustomerDetails'])->name('customer.repair.items.details');
		
		Route::get('/customer/repair-order-list/repair-order-view/{order_no}/{itemid}', [App\Http\Controllers\RepairController::class, 'showcustomersRepairOrderitemDetails'])->name('customer.repair.order.details');
		
		Route::get('/customer/view-nc-sales-items/{sale_id}', [App\Http\Controllers\NCSaleController::class, 'viewcustomerNCSalesItems'])->name('customer.view.NCsales.items');
		
		
  });

    Route::middleware(CheckUserType::class . ':purchase')->group(function () {

        Route::get('/purchase-list', [App\Http\Controllers\PurchaseController::class, 'getPurchaseList']);
        Route::get('/create-purchase', [App\Http\Controllers\PurchaseController::class, 'createAddPurchase'])->name('create.purchase');
		
        Route::post('/add-purchase', [App\Http\Controllers\PurchaseController::class, 'postAddPurchase'])->name('add.purchase');
        Route::get('/purchase-items-list/{purchase_id}', [App\Http\Controllers\PurchaseController::class, 'getPurchaseItemList'])->name('purchase.items');
        Route::post('/store-purchase-item', [App\Http\Controllers\PurchaseController::class, 'storePurchaseItem'])->name('store.purchase.items');
        Route::get('/get-purity/{itemTypeId}',  [App\Http\Controllers\PurchaseController::class, 'getPurity']);
        });

    Route::middleware(CheckUserType::class . ':karigar')->group(function () {

    Route::get('/karigar-list', [App\Http\Controllers\AdminController::class, 'getKarigarList'])->name('karigar.list');
    Route::get('/add-karigar', [App\Http\Controllers\AdminController::class, 'getAddKarigar']);
    Route::post('/add-karigarss', [App\Http\Controllers\AdminController::class, 'postAddKarigar'])->name('add.karigar');
    Route::get('/edit-karigar/{karigar_id}', [App\Http\Controllers\AdminController::class, 'editkarigar'])->name('edit.karigar');
    Route::post('/update-karigar/{karigar_id}', [App\Http\Controllers\AdminController::class, 'updatekarigar'])->name('update.karigar');
	  Route::get('/view-karigar-items/{karigar_id}', [App\Http\Controllers\AdminController::class, 'getAssignedItemsList'])->name('view.karigar');
		
	Route::get('/settle-karigar-account/{karigar_id}', [App\Http\Controllers\AdminController::class, 'settleKarigarAccount'])->name('settle.karigar.account');
		
	  Route::post('/karagir/update-status/{karigar_id}', [App\Http\Controllers\AdminController::class, 'updateStatus'])->name('karagir.updateStatus');
    });

    Route::middleware(CheckUserType::class . ':supplier')->group(function () {

    Route::get('/supplier-list', [App\Http\Controllers\AdminController::class, 'getSupplierList']);
    Route::get('/add-supplier', [App\Http\Controllers\AdminController::class, 'addSupplier'])->name('add.view.supplier');
		
    Route::post('/add-supplier', [App\Http\Controllers\AdminController::class, 'postAddSupplier'])->name('add.supplier');
    Route::get('/edit-supplier/{supplier_id}', [App\Http\Controllers\AdminController::class, 'editSupplier'])->name('edit.supplier');
    Route::get('/view-supplier/{supplier_id}', [App\Http\Controllers\AdminController::class, 'viewSupplier'])->name('view.supplier');
		
    Route::post('/update-supplier/{supplier_id}', [App\Http\Controllers\AdminController::class, 'updateSupplier'])->name('update.supplier');

    });

    Route::middleware(CheckUserType::class . ':stock')->group(function () {

        //Location Routes
        Route::get('/locations-list', [App\Http\Controllers\StockController::class, 'getStorageList']);
		 Route::get('/add-locations', [App\Http\Controllers\StockController::class, 'addlocationStorageList']);
        Route::post('/add-location', [App\Http\Controllers\StockController::class, 'postStorageList'])->name('add.storage.location');
        Route::get('/edit-location/{location_id}', [App\Http\Controllers\StockController::class, 'editLocation'])->name('edit.location');
        Route::post('/update-storage-locations/{location_id}', [App\Http\Controllers\StockController::class, 'updateStorageLocation'])->name('update.storage.location');
        
        //Sub Location Routes
        Route::get('/sub-locations-list', [App\Http\Controllers\StockController::class, 'getSubLocationList']);
        Route::get('/create-sub-location', [App\Http\Controllers\StockController::class, 'createSubLocation'])->name('create.sublocation');
		
        Route::post('/add-sub-location', [App\Http\Controllers\StockController::class, 'postSubLocationList'])->name('add.sub.location');
        Route::get('/edit-sub-location/{sub_location_id}', [App\Http\Controllers\StockController::class, 'editSubLocation'])->name('edit.sub.location');
        Route::post('/update-sub-locations/{sub_location_id}', [App\Http\Controllers\StockController::class, 'updateSubLocation'])->name('update.sub.location');

       // Categories Routes
        Route::get('/categories-list', [App\Http\Controllers\StockController::class, 'getCategoryList'])->name('categories.list');
        Route::get('/create-category', [App\Http\Controllers\StockController::class, 'createCategory'])->name('create.category');
		
        Route::post('/add-category', [App\Http\Controllers\StockController::class, 'postCategory'])->name('add.category');
        Route::get('/edit-categories/{category_id}', [App\Http\Controllers\StockController::class, 'editCategory'])->name('edit.category');
        Route::post('/update-categories/{category_id}', [App\Http\Controllers\StockController::class, 'updateCategory'])->name('update.category');

        // Categories size route
        Route::get('/categories-size-list', [App\Http\Controllers\StockController::class, 'getCategorySizeList'])->name('categories.size.list');
		Route::get('/create-categories-size', [App\Http\Controllers\StockController::class, 'createCategorySizeList'])->name('create.category.size');
        Route::post('/add-category-size', [App\Http\Controllers\StockController::class, 'postCategorySize'])->name('add.category.size');
        Route::get('/edit-categories-size/{categorysize_id}', [App\Http\Controllers\StockController::class, 'editCategorySize'])->name('edit.category.size');
        Route::post('/update-categories-size/{categorysize_id}', [App\Http\Controllers\StockController::class, 'updateCategorySize'])->name('update.category.size');

        // Categories shape Routes
        Route::get('/categories-shape-list', [App\Http\Controllers\StockController::class, 'getCategoryshapeList'])->name('categories.shape.list');
		Route::get('/create-categories-shape', [App\Http\Controllers\StockController::class, 'createCategoryshapeList'])->name('create.categories.shape');
        Route::post('/add-category-shape', [App\Http\Controllers\StockController::class, 'postCategoryshape'])->name('add.category.shape');
        Route::get('/edit-categories-shape/{categoryshape_id}', [App\Http\Controllers\StockController::class, 'editCategoryshape'])->name('edit.category.shape');
        Route::post('/update-categories-shape/{categoryshape_id}', [App\Http\Controllers\StockController::class, 'updateCategoryshape'])->name('update.category.shape');
         
        // Diamond  shape Routes
        Route::get('/diamond-shape-list', [App\Http\Controllers\StockController::class, 'getdiamondshapeList'])->name('diamond.shape.list');
        Route::get('/create-diamond-shape', [App\Http\Controllers\StockController::class, 'creatediamondshapeList'])->name('create.diamond.shape');
		
        Route::post('/add-diamond-shape', [App\Http\Controllers\StockController::class, 'postdiamondshape'])->name('add.diamond.shape');
        Route::get('/edit-diamond-shape/{diamondshape_id}', [App\Http\Controllers\StockController::class, 'editdiamondshape'])->name('edit.diamond.shape');
        Route::post('/update-diamond-shape/{diamondshape_id}', [App\Http\Controllers\StockController::class, 'updatediamondshape'])->name('update.diamond.shape');

        // Diamond  size Routes
        Route::get('/diamond-type-list', [App\Http\Controllers\StockController::class, 'getdiamondsizeList'])->name('diamond.type.list');
        Route::get('/create-diamond-type', [App\Http\Controllers\StockController::class, 'creatediamondsize'])->name('create.diamond.type');
		
        Route::post('/add-diamond-type', [App\Http\Controllers\StockController::class, 'postdiamondsize'])->name('add.diamond.type');
        Route::get('/edit-diamond-type/{diamondsize_id}', [App\Http\Controllers\StockController::class, 'editdiamondsize'])->name('edit.diamond.type');
        Route::post('/update-diamond-type/{diamondsize_id}', [App\Http\Controllers\StockController::class, 'updatediamondsize'])->name('update.diamond.type');
    
        //
        Route::get('/get-category-details/{category_id}',[App\Http\Controllers\StockController::class, 'getCategoryDetails'])->name('getCategoryDetails'); 

        // Item Type Routes
         Route::get('/item-type-list', [App\Http\Controllers\StockController::class, 'getItemTypeList'])->name('item.type.list');
         Route::get('/add-type-list', [App\Http\Controllers\StockController::class, 'addItemTypeList'])->name('item.type.add');
		
         Route::post('/add-item-type', [App\Http\Controllers\StockController::class, 'postItemType'])->name('add.item.type');
         Route::get('/edit-item-type/{item_type_id}', [App\Http\Controllers\StockController::class, 'editItemType'])->name('edit.item.type');
         Route::post('/update-item-type/{item_type_id}', [App\Http\Controllers\StockController::class, 'updateItemType'])->name('update.item.type');
         Route::get('/get-purity/{itemTypeId}',  [App\Http\Controllers\StockController::class, 'getPurity']);

      	//Stock Item Routes
        Route::get('/items-list', [App\Http\Controllers\StockController::class, 'getStockItems'])->name('stock.item');
        Route::post('/add-item', [App\Http\Controllers\StockController::class, 'postAddStockItems'])->name('add.stock.item');
        Route::get('/edit-item/{item_id}', [App\Http\Controllers\StockController::class, 'editItem'])->name('edit.item');
        Route::post('/update-item/{item_id}', [App\Http\Controllers\StockController::class, 'updateItem'])->name('update.item');
		    Route::post('/assign-stock', [App\Http\Controllers\StockController::class, 'assign'])->name('assign.stock');
		
        
        //Stock Filling Routes
        Route::get('/stock-filling', [App\Http\Controllers\StockController::class, 'getStockFilling']);
        Route::post('/stock-filling', [App\Http\Controllers\StockController::class, 'postStockFilling'])->name('update-stock.items');
        Route::get('/fetch-sublocations/{location_id}', [App\Http\Controllers\StockController::class, 'fetchSublocations']);
        Route::get('/stock-items/{subLocationId}', [App\Http\Controllers\StockController::class, 'showStockItems'])->name('show.stock.items');
        Route::get('/fill-sub-location/{subLocationId}', [App\Http\Controllers\StockController::class, 'fill'])->name('fill.sub.location');
        Route::get('/categories-excluding/{subLocationId}', [App\Http\Controllers\StockController::class, 'getItemsExcludingSubLocation']);
 		    Route::get('/location-excluding/{itemId}', [App\Http\Controllers\StockController::class, 'getItemsLocations']);


        //Stock Transfer(Out)
        Route::get('/stock-adjustment-list', [App\Http\Controllers\StockController::class, 'getStockAdjustmentList']);
        Route::get('/stock-adjustment', [App\Http\Controllers\StockController::class, 'stockAdjustment'])->name('stock.adjustment');
		
        Route::get('/adjust-stock', [App\Http\Controllers\StockController::class, 'getAdjustStock']);
        Route::post('/adjust-stock', [App\Http\Controllers\StockController::class, 'postAdjustStock'])->name('adjust.stock');
        Route::get('/get-items', [App\Http\Controllers\StockController::class, 'getItems'])->name('get.items');
    
    
    
      });

  

     Route::middleware(CheckUserType::class . ':rates')->group(function () {

        Route::get('/metal-rates-list', [App\Http\Controllers\AdminController::class, 'getRatesList']);
        Route::post('/add-metal-rates', [App\Http\Controllers\AdminController::class, 'postRate'])->name('add.rate');
        Route::get('/edit-metal-rates/{metal_id}', [App\Http\Controllers\AdminController::class, 'editRate'])->name('edit.rate');
        Route::post('/update-rate/{metal_id}', [App\Http\Controllers\AdminController::class, 'updateRate'])->name('update.rate');
     });
	
	Route::middleware(CheckUserType::class . ':repair-items')->group(function () {
		
		Route::post('/remove-items', [App\Http\Controllers\RepairController::class, 'removeItems'])->name('remove.item');
	Route::post('/remove-repair-items', [App\Http\Controllers\RepairController::class, 'removeRepairItems'])->name('remove.repair.item');

		Route::post('/remove-order', [App\Http\Controllers\RepairController::class, 'removeOrder'])->name('remove.order');
		Route::post('/remove-repair-order', [App\Http\Controllers\RepairController::class, 'removeRepairOrder'])->name('remove.repair.order');
		
		
		
       Route::get('/order-list', [App\Http\Controllers\RepairController::class, 'getOrderList'])->name('order-list');
	   Route::get('/order-list/{order_no}', [App\Http\Controllers\RepairController::class, 'showOrderDetails'])->name('order.details');
		
	   Route::get('/order-list/order-view/{order_no}/{itemid}', [App\Http\Controllers\RepairController::class, 'showcustomerOrderitemDetails'])->name('order.details.show');
		
		Route::get('/repair-order-list/repair-order-view/{order_no}/{itemid}', [App\Http\Controllers\RepairController::class, 'showcustomerRepairOrderitemDetails'])->name('repair.order.details.show');

       Route::post('/store-repair-order', [App\Http\Controllers\RepairController::class, 'storeRepairOrder'])->name('store.repair.order');
		Route::post('/store-new-repair-order', [App\Http\Controllers\RepairController::class, 'newstoreRepairOrder'])->name('store.newrepair.order');

       Route::get('/repair-order-list', [App\Http\Controllers\RepairController::class, 'getRepairItemsList'])->name('repair-items-list');
       Route::post('/add-repair-items', [App\Http\Controllers\RepairController::class, 'postAddRepairItem'])->name('add.repair.item');
       Route::post('/store-repair-item', [App\Http\Controllers\RepairController::class, 'storeRepairItem'])->name('store.repair.items');
       Route::get('/search-customer', [App\Http\Controllers\RepairController::class, 'searchCustomer'])->name('search.customer');
       Route::get('/get-customer-details/{customer_id}', [App\Http\Controllers\RepairController::class, 'getCustomerDetails']);
       Route::get('/get-purity/{itemTypeId}',  [App\Http\Controllers\RepairController::class, 'getPurity']);
       Route::get('/repair-items/{repair_order_no}', [App\Http\Controllers\RepairController::class, 'showDetails'])->name('repair.items.details');
		

		
      // Route::post('/store-customer', [App\Http\Controllers\RepairController::class, 'storeCustomer'])->name('store.customer');
	   Route::post('/assign-karigar', [App\Http\Controllers\RepairController::class, 'assignKarigar'])->name('assign.karigar');
	   Route::post('/assign-repair-karigar', [App\Http\Controllers\RepairController::class, 'assignRepairKarigar'])->name('assign.repair.karigar');
		
		       Route::get('/order-invoice/{repair_order_no}', [App\Http\Controllers\RepairController::class, 'repairinvoice'])->name('repair.invoice');
		
		       Route::get('/repair-invoice/{repair_order_no}', [App\Http\Controllers\RepairController::class, 'repairorderinvoice'])->name('repair.order.invoice');
		
       Route::post('/repair-sale', [App\Http\Controllers\SaleController::class, 'storeSaleRepair'])->name('store.sale-repair');
     });
	
	  Route::middleware(CheckUserType::class . ':sale')->group(function () {
      Route::get('/sales-list', [App\Http\Controllers\SaleController::class, 'getSalesList'])->name('sale.list');
        Route::get('/add-sale', [App\Http\Controllers\SaleController::class, 'getAddSale']);
        Route::post('/add-sale', [App\Http\Controllers\SaleController::class, 'storeSale'])->name('store.sale');
        Route::get('/search-customer-number', [App\Http\Controllers\SaleController::class, 'search']);
        Route::post('/add-new-customer', [App\Http\Controllers\SaleController::class, 'postNewCustomer'])->name('add.new.customer');
        
        Route::post('/update-sales', [App\Http\Controllers\SaleController::class, 'updateSales'])->name('update.sale');
		  
        Route::get('/view-sales-items/{sale_id}', [App\Http\Controllers\SaleController::class, 'viewSalesItems'])->name('view.sales.items');
        Route::get('/edit-sales-items/{sale_id}', [App\Http\Controllers\SaleController::class, 'editSalesItems'])->name('edit.sales.items');
      
	  });
	
		  Route::middleware(CheckUserType::class . ':ncsale')->group(function () {
      	Route::get('/nc-sales-list', [App\Http\Controllers\NCSaleController::class, 'getNCSalesList'])->name('ncsaleslist');
        Route::get('/add-nc-sale', [App\Http\Controllers\NCSaleController::class, 'getAddNCSale']);
        Route::post('/add-nc-sale', [App\Http\Controllers\NCSaleController::class, 'storeNCSale'])->name('store.NCsale');
        Route::get('/search-customer-number', [App\Http\Controllers\NCSaleController::class, 'search']);
        Route::post('/add-new-customer', [App\Http\Controllers\NCSaleController::class, 'postNewCustomer'])->name('add.new.customer');
        //Route::get('/fetch-item', [App\Http\Controllers\NCSaleController::class, 'fetchItem']);
        Route::get('/view-nc-sales-items/{sale_id}', [App\Http\Controllers\NCSaleController::class, 'viewNCSalesItems'])->name('view.NCsales.items');
			  
        Route::post('/remove-nc-sale-item/{id}/{ncsale_id}', [App\Http\Controllers\NCSaleController::class, 'removeItems'])->name('remove.NCsale.item');
		Route::post('/update-nc-sale-item-price/{id}/{ncsale_id}', [App\Http\Controllers\NCSaleController::class, 'updateItemPrice'])->name('update.NCsale.item.price');
			  
		Route::post('/update-nc-sale-payment/{ncsaleid}', [App\Http\Controllers\NCSaleController::class, 'updateNcSalesPayment'])->name('update.NCsale.payment');
			  
      });

       Route::middleware(CheckUserType::class . ':scrap-gold')->group(function () {
        Route::get('/scrap-gold', [App\Http\Controllers\ScrapController::class, 'getScrapGold']);
        Route::get('/add-scrap-gold', [App\Http\Controllers\ScrapController::class, 'getAddScrapGold']);
        Route::post('/add-scrap-gold', [App\Http\Controllers\ScrapController::class, 'postScrapGold'])->name('store.scrap.gold');
        Route::get('/search-customer-details', [App\Http\Controllers\ScrapController::class, 'searchMobileNumber']);
        Route::post('/new-customer', [App\Http\Controllers\ScrapController::class, 'addNewCustomer'])->name('new.customer');
        Route::get('/get-purity-details/{itemTypeId}',  [App\Http\Controllers\ScrapController::class, 'getPurityDetails']);
        Route::get('/view-scrap-items/{scrap_id}', [App\Http\Controllers\ScrapController::class, 'viewScrapItems'])->name('view.scrap.items');
      });
	
		Route::middleware(CheckUserType::class . ':quotation')->group(function () {
        Route::get('/create-sales-quotation', [App\Http\Controllers\QuotationController::class, 'getSalesQuotation']);
        Route::get('/sales-quotation', [App\Http\Controllers\QuotationController::class, 'getSalesQuotationlist']);
        Route::get('/view-quotation/{sale_id}', [App\Http\Controllers\QuotationController::class, 'getSalesQuotationview'])->name('view.quotation');
			
			
        Route::post('/store-sales-quotation', [App\Http\Controllers\QuotationController::class, 'postSalesQuotation'])->name('store.quotation');
        Route::get('/search-customer-mobile-no', [App\Http\Controllers\QuotationController::class, 'searchMobile']);
        Route::post('/customer-add', [App\Http\Controllers\QuotationController::class, 'storeNewCustomer'])->name('customer.add');
        Route::get('/fetch-item-details', [App\Http\Controllers\QuotationController::class, 'fetchItemDetails']);
      });



      //Online Dashboard Routes
      Route::middleware(CheckUserType::class . ':online')->group(function () {
  
        Route::get('/online-dashboard', function () {return view('dashboard.online-index');})->name('online-dashboard');

        //Online Customers Routes
        Route::get('/online-customers-list', [App\Http\Controllers\OnlineCustomerController::class, 'getOnlineCustomerList']);
        Route::get('/view-online-customer/{online_customer_id}', [App\Http\Controllers\OnlineCustomerController::class, 'viewOnlineCustomer'])->name('view.online.customer');

        //Product Catgeory Routes
        Route::get('/product-categories', [App\Http\Controllers\ProductController::class, 'getProductCategory']);
        Route::post('/product-categories', [App\Http\Controllers\ProductController::class, 'postProductCategory'])->name('store-product-category');
        Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'editProductCategory'])->name('edit-product-category');
        Route::post('/update/{id}', [App\Http\Controllers\ProductController::class, 'updateProductCategory'])->name('update-product-category');
        Route::delete('/category/{id}', [App\Http\Controllers\ProductController::class, 'deleteProductCategory'])->name('delete-product-category');

        //Product Attribute Routes
        Route::get('/product-attribute-list', [App\Http\Controllers\ProductController::class, 'getProductAttributeList']);
        Route::get('/create-new-attribute', [App\Http\Controllers\ProductController::class, 'getAddNewAttribute']);
        Route::post('/create-new-attribute', [App\Http\Controllers\ProductController::class, 'postNewAttribute'])->name('add-new-attribute');
        Route::get('/edit-product-attribute/{id}', [App\Http\Controllers\ProductController::class, 'getEditAttribute'])->name('edit-product-attribute');
        Route::put('/update-product-attribute/{id}', [App\Http\Controllers\ProductController::class, 'updateAttribute'])->name('update-product-attribute');
        Route::delete('/delete-product-attribute/{id}', [App\Http\Controllers\ProductController::class, 'deleteAttribute'])->name('delete-product-attribute');

        //Product Routes
        Route::get('/product-list', [App\Http\Controllers\ProductController::class, 'getProductList']);
        Route::get('/create-new-product', [App\Http\Controllers\ProductController::class, 'addNewProduct']);
        Route::post('/create-new-product', [App\Http\Controllers\ProductController::class, 'postAddProduct'])->name('store-product');
        Route::get('/edit-product/{id}', [App\Http\Controllers\ProductController::class, 'getEditProduct'])->name('edit-product');
        Route::post('/update-product/{id}', [App\Http\Controllers\ProductController::class, 'updateProduct'])->name('update-product');

        Route::get('/get-attribute-values', [App\Http\Controllers\ProductController::class, 'getAttributeValues'])->name('get-attribute-values');
        
        //Product Variation Routes
        Route::post('/generate-variations/{product_id}', [App\Http\Controllers\ProductController::class, 'generateVariations'])->name('generate-variations');
        Route::post('/update-variations', [App\Http\Controllers\ProductController::class, 'updateVariations'])->name('update.variations');
        Route::delete('/delete-variation/{id}', [App\Http\Controllers\ProductController::class, 'deleteVariations'])->name('delete-variation');
        Route::post('/upload-variations-excel', [App\Http\Controllers\ProductController::class, 'uploadVariationsExcel'])->name('upload-variations-excel');
		  
		    Route::post('/upload-images', [App\Http\Controllers\ProductController::class, 'uploadImages'])->name('images.upload');


        //Media Routes
        Route::get('/media',[App\Http\Controllers\MediaController::class, 'showMedia'])->name('media');
        Route::get('/media/folder/{folder}', [App\Http\Controllers\MediaController::class, 'showFolder'])->name('media-folder');
        Route::post('/upload-files', [App\Http\Controllers\MediaController::class, 'uploadFiles'])->name('upload-files');
        Route::post('/media/create-folder',[App\Http\Controllers\MediaController::class, 'createFolder'])->name('media-create-folder');
        Route::post('/media/rename-folder/{folderName}', [App\Http\Controllers\MediaController::class, 'renameFolder'])->name('media.rename-folder');
        Route::post('/delete-folder/{folder}', [App\Http\Controllers\MediaController::class, 'deleteFolder'])->name('media-delete-folder');

        //Taxes Routes
        Route::get('/tax-list', [App\Http\Controllers\TaxController::class, 'getTaxList']);
        Route::get('/create-new-tax', [App\Http\Controllers\TaxController::class, 'addNewTax']);
        Route::post('/create-new-tax', [App\Http\Controllers\TaxController::class, 'postNewTax'])->name('store-tax');
        Route::get('/edit-tax/{id}', [App\Http\Controllers\TaxController::class, 'getEditTax'])->name('edit-tax');
        Route::post('/update-tax/{id}', [App\Http\Controllers\TaxController::class, 'updateTax'])->name('update-tax');
        Route::delete('/delete-tax/{id}', [App\Http\Controllers\TaxController::class, 'deleteTax'])->name('delete-tax');

        //Discount Routes
        Route::get('/discount-list', [App\Http\Controllers\DiscountController::class, 'getDiscountList']);
        Route::get('/create-new-discount', [App\Http\Controllers\DiscountController::class, 'addNewDiscount']);
        Route::post('/create-new-discount', [App\Http\Controllers\DiscountController::class, 'postNewDiscount'])->name('store-discount');
        Route::get('/edit-discount/{id}', [App\Http\Controllers\DiscountController::class, 'getEditDiscount'])->name('edit-discount');
        Route::post('/update-discount/{id}', [App\Http\Controllers\DiscountController::class, 'updateDiscount'])->name('update-discount');
        Route::delete('/delete-discount/{id}', [App\Http\Controllers\DiscountController::class, 'deleteDiscount'])->name('delete-discount');
        Route::get('/get-products', [App\Http\Controllers\DiscountController::class, 'getProducts'])->name('get-products');
        Route::get('/get-product-category', [App\Http\Controllers\DiscountController::class, 'getProductCategory'])->name('get-product-category');

        //Online Orders Routes
        Route::get('/online-orders-list', [App\Http\Controllers\OnlineOrdersController::class, 'getOnlineOrders']);
        Route::get('/online-order/{id}',  [App\Http\Controllers\OnlineOrdersController::class, 'viewOnlineOrder'])->name('view.online.order');

		    //Blogs Routes
        Route::get('/blogs-list', [App\Http\Controllers\BlogController::class, 'getBlogsList'])->name('blogs');
        Route::get('/add-blogs', [App\Http\Controllers\BlogController::class, 'addBlogs'])->name('add.blogs');
        Route::post('/store-blog', [App\Http\Controllers\BlogController::class, 'storeblogs'])->name('store.blog');
        Route::get('/edit/blog/{id}', [App\Http\Controllers\BlogController::class, 'editblog']);
        Route::post( '/update-blog', [App\Http\Controllers\BlogController::class, 'updateblogs'])->name('update.blog');
        Route::delete( '/blog/delete/{id}', [App\Http\Controllers\BlogController::class, 'deleteblog'])->name('admin.deleteblog');

        //CATEGOTIRS ROUTES
        Route::get('/blog-categories', [App\Http\Controllers\BlogController::class, 'categories'])->name('blog.categories');
        Route::post('/store-category', [App\Http\Controllers\BlogController::class, 'storecategories'])->name('store.category');
        Route::post( '/update-category', [App\Http\Controllers\BlogController::class, 'updatecategories'])->name('update.blog.category');
        Route::delete('/category/delete/{id}', [App\Http\Controllers\BlogController::class, 'deleteCategory'])->name('admin.deleteCategory');

        //TAGS ROUTES
        Route::get('/tags', [App\Http\Controllers\BlogController::class, 'tags'])->name('tags');
        Route::post('/store-tags', [App\Http\Controllers\BlogController::class, 'storetags'])->name('store.tag');
        Route::post( '/update-tags', [App\Http\Controllers\BlogController::class, 'updatetags'])->name('update.tag');
        Route::delete('/tag/delete/{id}', [App\Http\Controllers\BlogController::class, 'deletetag'])->name('admin.deletetag');
        Route::post('/store-tag', [App\Http\Controllers\BlogController::class, 'storetag'])->name('store.tags');


    });

   


  
});


require __DIR__.'/auth.php';