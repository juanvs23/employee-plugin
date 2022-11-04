import { useState, useRef, useEffect } from 'react';
import './requirement.scss';
import RequirementItem from './RequirementItem';
import ReactQuill from 'react-quill';
import 'react-quill/dist/quill.snow.css';
export default function Requirements({ name, title, buttonTitle, jobData }) {
	const inputRef = useRef();
	const [textRequirement, settextRequirement] = useState(jobData.info);
	const [list, setList] = useState(jobData.items);
	const [position, setPosition] = useState(null);

	const handlerClick = () => {
		if (inputRef.current.value.length < 3) return null;
		setList([
			...list,
			{
				text: inputRef.current.value,
				index: list.length,
			},
		]);
		inputRef.current.value = '';
	};
	const redefinition = (array) => {
		const newList = array.filter((item) => item.index !== position);
		return newList.map((item, i) => ({ ...item, index: i }));
	};
	useEffect(() => {
		if (position !== null) {
			setList(redefinition(list));
		}
		return () => {
			setPosition(null);
		};
	}, [position]);

	return (
		<div className='row'>
			<div className='col-3'>
				<label htmlFor={`${name}-input`}>
					<h3 style={{ marginTop: '0px' }}>{title}</h3>
				</label>
			</div>

			<div className='col-9'>
				<input type='hidden' name={`${name}`} value={JSON.stringify(list)} />
				<input type='hidden' name={`${name}-info`} value={textRequirement} />
				<ReactQuill
					name='test'
					theme='snow'
					value={textRequirement}
					onChange={settextRequirement}
				/>
				;
				<div className='row'>
					<div className='col-9'>
						<input
							type='text'
							ref={inputRef}
							id={`${name}-input`}
							className='form-control'
						/>
					</div>
					<div className='col-3'>
						<button
							onClick={handlerClick}
							type='button'
							className='button button-primary button-large'>
							{buttonTitle}
						</button>
					</div>
				</div>
				<div className='row'>
					<div className='col-9'>
						<p className='infoList'>{`Lista de ${title}`}</p>
						<ol className='row-list'>
							{list.map((item, i) => {
								return (
									<RequirementItem
										position={position}
										setPosition={setPosition}
										text={item.text}
										index={item.index}
										key={i}
									/>
								);
							})}
						</ol>
					</div>
				</div>
			</div>
		</div>
	);
}
