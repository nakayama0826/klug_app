// csrfToken.ts
export const getCsrfToken = (): string | null => {
	const tokenMetaTag = document.querySelector('meta[name="csrf-token"]');
	return tokenMetaTag ? tokenMetaTag.getAttribute('content') : null;
      };