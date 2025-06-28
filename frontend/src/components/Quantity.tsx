import { useState } from 'react';

interface quantityProps {
    min?: number;
    max?: number;
    value?: number;
    onChange?: (value: number) => void;
}

export default function Quantity({ min = 1, max, value, onChange }: quantityProps) {
  const [count, setCount] = useState(value || min);

  const update = (newCount: number) => {
    if (newCount >= min && newCount <= max) {
      setCount(newCount);
      onChange?.(newCount);
    }
  };

  return (
    <div className="flex overflow-hidden items-center rounded-md border border-gray-300 w-fit">
      <button
        type="button"
        onClick={() => update(count - 1)}
        className="flex justify-center items-center w-8 h-8 text-lg font-semibold bg-gray-100 rounded cursor-pointer hover:bg-gray-200"
      >
        −
      </button>
      <div className="flex justify-center items-center w-10 h-8 text-sm font-medium bg-white">
        {count}
      </div>
      <button
        type="button"
        onClick={() => update(count + 1)}
        className="flex justify-center items-center w-8 h-8 text-lg font-semibold bg-gray-100 rounded cursor-pointer hover:bg-gray-200"
      >
        +
      </button>
    </div>
  );
}
