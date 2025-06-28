import React from "react";

interface InputComponentProps extends React.InputHTMLAttributes<HTMLInputElement> {
  label: string;
  type: string;
  id: string
  value: string
  onChange: string
  placeholder: string
}

export default function InputComponent({
  label,
  type,
  id,
  value,
  onChange,
  placeholder,
  required = false,
  ...props
}: InputComponentProps) {
  return (
    <div>
      <label htmlFor={id} className="block text-sm font-medium text-gray-700 mb-1">
        {label}
      </label>
      <input
        type={type}
        id={id}
        className="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-zinc-900"
        placeholder={placeholder}
        required={required}
        value={value}
        onChange={onChange}
        {...props}
      />
    </div>
  );
}