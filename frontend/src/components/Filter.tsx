import { useEffect, useState } from 'react';
import api from '../services/apiClient';

export default function FilterSidebar({ onApply, onClose, isOpened }) {
  const [price, setPrice] = useState([0, 3000]);
  const [selectedCategories, setSelectedCategories] = useState([]);
  const [categories, setCategories] = useState([]);

  const toggleCategory = (cat) => {
    if (selectedCategories.includes(cat)) {
      setSelectedCategories(selectedCategories.filter(c => c !== cat));
    } else {
      setSelectedCategories([...selectedCategories, cat]);
    }
  };

  const handleAllClick = () => {
    setSelectedCategories([]);
  };

  const clearFilters = () => {
    setSelectedCategories([]);
    setPrice([0, 3000]);
  };

  useEffect(() => {
      api.get('/api/v1/categories')
        .then((res) => {
          setCategories(res.data.data)
        })
        .catch((err) => {
          //
        })
        .finally(() => '');
    }, []);

  return (
    <div className={`w-72 p-5 bg-gray-50 h-full shadow-md fixed top-0 transition-all z-10 ${isOpened ? 'left-0' : '-left-full'}`}>
      <div className="flex justify-between items-center mb-6">
        <h2 className="text-lg font-bold">Filters</h2>
        <button onClick={onClose} className="text-xl text-gray-500">&times;</button>
      </div>

      {/* Price Filter */}
      <div className="mb-6">
        <div className="flex justify-between items-center cursor-pointer">
          <h3 className="mb-2 font-medium">Price</h3>
        </div>
        <input
          type="range"
          min={0}
          max={3000}
          value={price[1]}
          onChange={(e) => setPrice([0, parseInt(e.target.value)])}
          className="w-full"
        />
        <div className="flex justify-between mt-1 text-sm text-gray-600">
          <span>${price[0]}</span>
          <span>${price[1]}</span>
        </div>
      </div>

      {/* Category Filter */}
      <div className="mb-6">
        <div className="flex justify-between items-center cursor-pointer">
          <h3 className="mb-2 font-medium">Category</h3>
        </div>
        <div className="space-y-2">
          <label className="flex items-center space-x-2">
            <input
              type="radio"
              name="category"
              checked={selectedCategories.length === 0}
              onChange={handleAllClick}
              className="accent-blue-600"
            />
            <span>All</span>
          </label>
          {categories.map((category) => (
            <label key={category.id} className="flex items-center space-x-2">
              <input
                type="checkbox"
                checked={selectedCategories.includes(category.id)}
                onChange={() => toggleCategory(category.id)}
                className="accent-blue-600"
              />
              <span>{category.name}</span>
            </label>
          ))}
        </div>
      </div>

      {/* Buttons */}
      <div className="absolute left-0 bottom-4 px-5 w-full">
        <button
          className="py-2 w-full text-white bg-black rounded-md"
          onClick={() => onApply({ price, categories: selectedCategories })}
        >
          Apply Filter
        </button>
        <button
          className="mt-2 w-full text-sm text-gray-500 underline"
          onClick={clearFilters}
        >
          Clear all filters
        </button>
      </div>
    </div>
  );
}
