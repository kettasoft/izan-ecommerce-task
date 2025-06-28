import ProductItem from "../components/ProductItem";
import { useEffect, useState } from 'react';
import api from "../services/apiClient";
import FilterSidebar from "../components/Filter";
import OpenFilterSidebarIcon from '../assets/icons/mage_filter-fill.png';
import OrderSummary from '../components/OrderSummary';

export default function ProductsPage() {
  const [products, setProducts] = useState([]);
  const [showFilters, setShowFilters] = useState(false);
  const [filters, setFilters] = useState({});
  const [name, setName] = useState('');
  const closeFilters = () => setShowFilters(false);

  const toggleFilters = () => setShowFilters((prev) => !prev);

  const handleFilterApply = (filters) => {
    setFilters(filters);
  };

  const handleQuantityChange = (id, quantity) => {
    api.put(`/api/v1/carts/${id}`, { quantity });
  };



  const handleCheckout = () => {
    api.post('/api/v1/orders');
  };

  useEffect(() => {
    api.get('/api/v1/products', { params: { ...filters, name } })
      .then((res) => {
        setProducts(res.data.data);
      })
      .catch((err) => {
        console.error('فشل تحميل المنتجات', err);
      })
      .finally(() => '');
  }, [filters, name]);

  return (
    <div className="">
      <div className="flex flex-wrap gap-4 justify-between sm:flex-wrap lg:flex-nowrap">
        <div className="flex-auto sm:flex-auto lg:flex-2/3">
          <div className="p-5 bg-white rounded-lg shadow">
            <input className="p-3 w-full bg-white rounded-lg border border-gray-300" type="text" placeholder="Search" onChange={(e) => setName(e.target.value)} />

            <div className="my-10">
              <h2 className="text-3xl font-bold">Casual</h2>

              <div className="mb-5">Showing 1-6 of 6 Products</div>

              <div className="grid grid-cols-1 gap-4 p-4 md:grid-cols-3">
                {products.map((product) => (
                  <ProductItem key={product.id} product={product} onQuantityChange={handleQuantityChange}></ProductItem>
                ))}
              </div>
            </div>
          </div>
        </div>
        <div className="flex-auto sm:flex-auto lg:flex-1/3">
            <OrderSummary onQuantityChange={handleQuantityChange} onCheckout={handleCheckout}></OrderSummary>
        </div>
      </div>

      <FilterSidebar onClose={closeFilters} isOpened={showFilters} onApply={handleFilterApply}></FilterSidebar>

      <div className="fixed left-0 top-28">
        <div onClick={toggleFilters} className="p-3 bg-white rounded-lg shadow cursor-pointer">
          <img src={OpenFilterSidebarIcon} className="w-full" width={100} height={100} alt="" />
        </div>
      </div>
    </div>
  );
}
