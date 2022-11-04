import { useRef } from 'react';

export default function DaysComponent({ currentDay, days, setDay }) {
	const checkRef = useRef();
	const capitalice = (day) => {
		const lower = day.toLowerCase();
		return day.charAt(0).toUpperCase() + day.slice(1);
	};
	const handlerChange = () => {
		const check = checkRef.current.checked;

		const current = currentDay;
		if (check) {
			setDay((days) => [...days, current]);
		} else {
			setDay(function (days) {
				const newDays = days.filter((element) => element !== current);
				return newDays;
			});
		}
	};
	const checkDay = days.includes(currentDay) ? true : false;

	return (
		<div className='form-check'>
			<input
				className='form-check-input'
				type='checkbox'
				ref={checkRef}
				onChange={handlerChange}
				defaultChecked={checkDay}
				id={currentDay}
			/>
			<label className='form-check-label' htmlFor={currentDay}>
				{capitalice(currentDay)}
			</label>
		</div>
	);
}
