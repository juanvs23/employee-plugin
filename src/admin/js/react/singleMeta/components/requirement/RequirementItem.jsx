export default function RequirementItem({ text, setPosition, index }) {
	const handlerButton = () => {
		setPosition(index);
	};
	return (
		<li className='item__list'>
			<div
				className='d-flex justify-content-between align-items-center'
				style={{ gap: '15px' }}>
				<p className='item__list__text'>{text}</p>
				<button
					type='button'
					onClick={handlerButton}
					className='btn-badget item__list__button'>
					<i className='fa fa-times'></i>
				</button>
			</div>
		</li>
	);
}
